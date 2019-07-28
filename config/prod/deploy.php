<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

/*
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
            ->keepReleases(2)
            ->symfonyEnvironment('prod')
            ->warmupCache(true)
            ->remoteComposerBinaryPath('composer')
            //->installWebAssets(true)
            //->dumpAsseticAssets(false)
            ->useSshAgentForwarding(true)
            ->composerInstallFlags('--prefer-dist --no-interaction')
            //->resetOpCacheFor(string $homepageUrl)
        ;
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        //$this->log('Checking that the repository is in a clean state.');
        //$this->runLocal('git diff --quiet');

        // $this->runLocal('./vendor/bin/simple-phpunit');
    }

    public function beforePreparing()
    {
        $this->log('Create symlynk to environment file .env');
        $results = $this->runRemote('if [ ! -f "../../shared/.env" ]; then echo "file not found"; else echo "file exist"; fi');

        foreach ($results as $result) {
            $fileExistResult = trim(str_replace('\n', '', $result->getOutput()));
            if ($fileExistResult === 'file not found') {
                throw new Exception("Файл .env не существует по пути {$this->getConfig('deployDir')}/shared/.env. \nСоздайте его и задайти все необходимые для приложения настройки окружения.");
            }
        }

        $this->runRemote('ln -s ../../shared/.env ./.env ');
        $this->runRemote('ln -s ../../shared/uploads ./public/uploads ');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        $this->runRemote('{{ console_bin }} doctrine:migrations:migrate');
        $this->runRemote('{{ console_bin }} liip:imagine:cache:remove ');

        $this->log('Деплой завершен!');
    }
};
