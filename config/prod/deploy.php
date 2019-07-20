<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

/**
 * Команды:
 * bin/console deploy <stege> -v --dry-run
 * --dry-run - запустить без выполнения команд, чтобы посмотреть, что будет выполнено
 * -v - отобразить  подробную информацию о процессе деплоя
 */
return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('nova@213.226.124.194')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/home/nova/public_html')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:anvein/nova.git')
            // the repository branch to deploy
            ->repositoryBranch('master')
            //->useSshAgentForwarding(true)
        ;
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        // $this->runLocal('./vendor/bin/simple-phpunit');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
         $this->runRemote('{{ console_bin }} doctrine:migrations:migrate');

         $this->runLocal('Деплой завершен!');
    }
};
