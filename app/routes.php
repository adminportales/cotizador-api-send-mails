<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });
    $app->post('/sendMail', function (Request $request, Response $response) {
        $data = $request->getParsedBody();

        // Create the Transport
        $transport = (new Swift_SmtpTransport('mail.bhtrademarketlatam.com', 465, 'ssl'))
            ->setUsername('cotizaciones@bhtrademarketlatam.com')
            ->setPassword('L1y^XgVG9KT*');

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['cotizaciones@bhtrademarketlatam.com' => 'Beatriz Luna'])
            ->setTo(['antoniotd87@gmail.com'])
            ->setBody('Here is the messsage itself');
        $result = $mailer->send($message);
        $payload = json_encode($result);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
