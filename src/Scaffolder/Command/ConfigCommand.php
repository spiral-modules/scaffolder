<?php
/**
 * Spiral Framework. Scaffolder
 *
 * @license MIT
 * @author  Valentin V (vvval)
 */
declare(strict_types=1);

namespace Spiral\Scaffolder\Command;

use Spiral\Scaffolder\Declaration\ConfigDeclaration;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ConfigCommand extends AbstractCommand
{
    protected const ELEMENT = 'config';

    protected const NAME        = 'create:config';
    protected const DESCRIPTION = 'Create config declaration';
    protected const ARGUMENTS   = [
        [
            'name',
            InputArgument::REQUIRED,
            'config name, or a config filename if "-r" flag is set ({path/to/configs/directory/}{config/filename}.php)'
        ]
    ];

    protected const OPTIONS = [
        [
            'comment',
            'c',
            InputOption::VALUE_OPTIONAL,
            'Optional comment to add as class header'
        ],
        [
            'reverse',
            'r',
            InputOption::VALUE_OPTIONAL,
            'Create config class based on a given config filename'
        ],
    ];

    /**
     * Create config declaration.
     */
    public function perform(): void
    {
        /** @var ConfigDeclaration $declaration */
        $declaration = $this->createDeclaration(['configName' => $this->argument('name')]);
        $declaration->create((bool)$this->option('reverse'));

        $this->writeDeclaration($declaration);
    }
}
