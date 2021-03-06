<?php
/**
 *
 * @package EPV
 * @copyright (c) 2014 phpBB Group
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */
namespace epv\Tests\Tests;


use epv\Files\FileInterface;
use epv\Files\Type\ServiceFileInterface;
use epv\Output\Output;
use epv\Output\OutputInterface;
use epv\Tests\BaseTest;
use epv\Tests\Exception\TestException;

class epv_test_validate_service extends BaseTest {


    public function __construct($debug, OutputInterface $output, $basedir, $namespace, $titania)
    {
        parent::__construct($debug, $output, $basedir, $namespace, $titania);

        $this->fileTypeFull = Type::TYPE_SERVICE;
        $this->totalFileTests = 1;
    }

    public function validateFile(FileInterface $file)
    {
        if (!$file instanceof ServiceFileInterface)
        {
            throw new TestException("This test expects a service type, but found something else.");
        }
        $this->validate($file);
    }

    /**
     * Do the actual validation of the service file.
     * @param ServiceFileInterface $file
     */
    private function validate(ServiceFileInterface $file)
    {
        $yml = $file->getYaml();

        if (!isset ($yml['services']))
        {
            $this->output->addMessage(Output::WARNING, "Service does not contain a 'services' key.");
        }
        else
        {
            $this->output->printErrorLevel();
        }
    }

    /**
     *
     * @return String
     */
    public function testName()
    {
        return "Validate service";
    }
}
