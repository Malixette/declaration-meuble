<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmailTestController extends Controller
{
    /**
     * @Route("/email/test", name="email_test")
     */
    public function sendEmail( \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('charmeleonh2pc@gmail.com')
            ->setTo('mayerma91@gmail.com')
            ->setBody('You should see me from the profiler!')
        ;
    
        dump($message);
        $mailer->send($message);
    
        return $this->render('email_test/index.html.twig', [
            'controller_name' => 'EmailTestController',
        ]);
    }
    
    public function testMailIsSentAndContentIsOk()
    {
        $client = static::createClient();

        // enables the profiler for the next request (it does nothing if the profiler is not available)
        $client->enableProfiler();

        $crawler = $client->request('POST', '/path/to/above/action');

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        // checks that an email was sent
        $this->assertSame(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting email data
        $this->assertInstanceOf('Swift_Message', $message);
        $this->assertSame('Hello Email', $message->getSubject());
        $this->assertSame('send@example.com', key($message->getFrom()));
        $this->assertSame('recipient@example.com', key($message->getTo()));
        $this->assertSame(
            'You should see me from the profiler!',
            $message->getBody()
        );
    }
}
