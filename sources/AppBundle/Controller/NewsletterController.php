<?php


namespace AppBundle\Controller;

use Afup\Site\Utils\Mailing;
use AppBundle\Mailchimp\SubscriberType;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends SiteBaseController
{
    public function subscribeFormAction()
    {
        return $this->render(':site/newsletter:subscribe.html.twig', ['form' => $this->getSubscriberType()->createView()]);
    }

    public function subscribeAction(Request $request)
    {
        $subscribeForm = $this->getSubscriberType();
        $subscribeForm->handleRequest($request);

        if ($subscribeForm->isSubmitted() && $subscribeForm->isValid()) {
            $keyb64 = $this->getParameter('newsletter_aes_key');
            $key = base64_decode($keyb64);
            $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
            $iv = openssl_random_pseudo_bytes($ivlen);
            $ciphertext_raw = openssl_encrypt($subscribeForm->getData()['email'], $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
            $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
            $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
            $base64Url = str_replace(['+', '/', '='], ['-', '_', ''], $ciphertext);

            $success = Mailing::envoyerMail(
                array($GLOBALS['conf']->obtenir('mails|email_expediteur'), $GLOBALS['conf']->obtenir('mails|nom_expediteur')),
                array($subscribeForm->getData()['email'], ''),
                'Inscription à la Newsletter de l\'AFUP',
                $this->renderView('site/newsletter/mail_confirmation.html.twig', ['tokenb64'=> $base64Url])
            );

            return $this->render(':site/newsletter:confirmsubscribe.html.twig', ['success' => $success]);
        }

        return $this->redirect('/');
    }

    public function confirmSubscribeAction($token) {

        $keyb64 = $this->getParameter('newsletter_aes_key');
        $key = base64_decode($keyb64);

        $base64 = str_replace(['-', '_'], ['+', '/'], $token);
        $data = base64_decode($base64);

        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($data, 0, $ivlen);
        $hmac = substr($data, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($data, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);

        $success = false;
        if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
        {

            try {
                $this->get('app.mailchimp_api')->subscribeAddress(
                    $this->getParameter('mailchimp_subscribers_list'),
                    $original_plaintext
                );
                $success = true;
            } catch (\Exception $e) {
                $success = false;
            }
        }
        return $this->render(':site/newsletter:postsubscribe.html.twig', ['success' => $success]);
    }

    private function getSubscriberType()
    {
        return $this
            ->createForm(SubscriberType::class, null, [
                'action' => $this->generateUrl('newsletter_subscribe'),
                'method' => Request::METHOD_POST
            ])
        ;
    }
}
