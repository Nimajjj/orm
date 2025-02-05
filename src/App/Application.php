<?php

namespace App\App;

use App\App\Commands\AddUserCommand;
use App\App\Commands\DeleteUserCommand;
use App\App\Commands\UpdateUserCommand;
use App\App\Entity\News;
use App\App\Manager\NewsEntityManager;
use App\App\Observers\UserObserver;
use App\App\Services\EmailService;
use App\App\Services\NewsService;
use App\App\Services\UserService;
use App\App\CommandParser;
use App\App\Email;
use App\Factory\NewsFactory;
use App\VO\Uid;

class Application
{
    private UserService $userService;
    private EmailService $emailService;
    private NewsService $newsService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->emailService = new EmailService();
        $this->newsService = new NewsService();

        // Attach observers
        $this->userService->attach(new UserObserver($this->emailService, $this->newsService));
    }

    public function run(array $argv): void
    {
        if (count($argv) < 2) {
            echo "Erreur : Commande manquante.\n";
            return;
        }

        $command = $argv[1];
        $input = json_decode(file_get_contents('php://stdin'), true);

        switch ($command) {
            case 'add':
                $addUserCommand = new AddUserCommand($this->userService);
                $result = $addUserCommand->execute($input);
                break;
            case 'update':
                $updateUserCommand = new UpdateUserCommand($this->userService);
                $result = $updateUserCommand->execute($input);
                break;
            case 'delete':
                $deleteUserCommand = new DeleteUserCommand($this->userService);
                $result = $deleteUserCommand->execute($input);
                break;
            default:
                echo "Erreur : Commande inconnue.\n";
                return;
        }

        if (isset($result['error'])) {
            echo "Erreur : " . $result['error'] . "\n";
        } else {
            echo json_encode($result) . "\n";
        }
    }
}