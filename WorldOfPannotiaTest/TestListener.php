<?php
namespace WorldOfPannotiaTest;

class TestListener extends \PHPUnit_Util_Log_JSON {
    protected $previousTestSuiteName = array();

    protected function setNewTestSuiteName($name) {
        $this->parentTestSuiteName = '';
        if (strpos($name, '::') !== false) {
            $this->parentTestSuiteName = $this->currentTestSuiteName;
        }
        return $name;
    }

    public function startTestSuite(\PHPUnit_Framework_TestSuite $suite) {
        $this->currentTestSuiteName = $this->setNewTestSuiteName($suite->getName());
        $this->currentTestName      = '';

        $this->write(
            array(
            'event' => 'suiteStart',
            'suite' => $this->currentTestSuiteName,
            'tests' => count($suite)
            )
        );
    }

    protected function resetTestSuiteName() {
        $return = '';
        if ($this->parentTestSuiteName !== '') {
            $return = $this->parentTestSuiteName;
            $this->parentTestSuiteName = '';
        }
        return $return;
    }

    public function endTestSuite(\PHPUnit_Framework_TestSuite $suite) {
        $this->write(
            array(
                'event' => 'suiteEnd',
                'suite' => $this->currentTestSuiteName,
                'tests' => count($suite)
            )
        );

        $this->currentTestSuiteName = $this->resetTestSuiteName();
        $this->currentTestName      = '';
    }
}
