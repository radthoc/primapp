<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use AppBundle\Util\NumberPatternGenerator;
use AppBundle\Util\MatrixGenerator;

class NumberPatternTableCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:number-pattern-table')
            ->setDescription('Generate a numbers table with the selected pattern')
            ->addArgument('length', InputArgument::OPTIONAL, 'How many numbers?')
            ->addArgument('pattern', InputArgument::OPTIONAL, 'What pattern would you like?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $length = $input->getArgument('length');
        if (empty($length)) {
            $length = NumberPatternGenerator::DEFAULT_PATTERN_LENGTH;
        }

        $pattern = $input->getArgument('pattern');
        if (empty($pattern)) {
            $pattern = NumberPatternGenerator::DEFAULT_PATTERN;
        }

        $output->writeln(
            '<info>Generates a multiplication table of the first ' .
            $length .
            ' ' .
            $pattern .
            ' numbers</info>'
        );

        try {
            $numbers = $this->getNumbers($pattern, $length);
            $numbersMatrix = $this->getNumbersMatrix($numbers);

            $table = new Table($output);
            $table->setRows($numbersMatrix);
            $table->render();
        } catch (\Exception $e) {
            $output->writeln('<error>Error: '.  $e->getMessage() . '</error>');
        }
    }
    
    /**
     *
     * @return array
     */
    private function getNumbers($pattern, $length)
    {
        /** @var NumberPatternGenerator $numberPatternGenerator */
        $numberPatternGenerator = $this->getContainer()
            ->get('app.number.pattern.generator');

        return $numberPatternGenerator->getNumbers($pattern, $length);
    }

    /**
     * @param integer $numbers
     * @return array
     */
    private function getNumbersMatrix($numbers)
    {
        /** @var MatrixGenerator $matrixGenerator */
        $matrixGenerator = $this->getContainer()
            ->get('app.matrix.generator');

        return $matrixGenerator->create($numbers);
    }
}
