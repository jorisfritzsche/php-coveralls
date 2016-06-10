<?php

namespace Satooshi\Component\System\Git;

use Satooshi\Component\System\SystemCommand;

/**
 * Git command.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class GitCommand extends SystemCommand
{
    /**
     * Command name or path.
     *
     * @var string
     */
    protected $commandPath = 'git';

    // API

    /**
     * Return branch names.
     *
     * @return array
     */
    public function getBranches()
    {
        $lastCommitCommand = $this->createCommand('rev-parse HEAD');
        $lastCommit = $this->executeCommand($lastCommitCommand);

        $command = $this->createCommand('branch --contains ' . $lastCommit);

        return $this->executeCommand($command);
    }

    /**
     * Return HEAD commit.
     *
     * @return array
     */
    public function getHeadCommit()
    {
        $command = $this->createCommand("log -1 --pretty=format:'%H%n%aN%n%ae%n%cN%n%ce%n%s'");

        return $this->executeCommand($command);
    }

    /**
     * Return remote repositories.
     *
     * @return array
     */
    public function getRemotes()
    {
        $command = $this->createCommand('remote -v');

        return $this->executeCommand($command);
    }
}
