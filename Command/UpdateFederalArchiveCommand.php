<?php
// src/Command/UpdateFederalArchiveCommand.php
namespace Owp\OwpCore\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Owp\OwpCore\Repository\BaseRepository;
use Owp\OwpCore\Repository\ClubRepository;
use Owp\OwpCore\Entity\Base;
use Owp\OwpCore\Entity\Club;

class UpdateFederalArchiveCommand extends Command
{
    protected static $defaultName = 'app:federale-archive:update';

    const COLUMN_BASE_ID = 3;
    const COLUMN_LAST_NAME = 4;
    const COLUMN_FIRST_NAME = 5;
    const COLUMN_SI_NUMBER = 1;
    const COLUMN_CLUB = 9;
    const COLUMN_CLUB_NAME = 10;

    private $em;
    private $baseRepository;
    private $clubRepository;

    public function __construct(EntityManagerInterface $em, BaseRepository $baseRepository, ClubRepository $clubRepository, $name = null)
    {
        parent::__construct($name);

        $this->em = $em;
        $this->baseRepository = $baseRepository;
        $this->clubRepository = $clubRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Mise à jour de l\'archive fédérale')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Cette commande vous permet de mettre à jour la base de données avec l\'archive fédérale datée de ce jour.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Mise à jour de l\'archive fédérale');

        $output->writeln('Téléchargement de l\'archive fédérale du jour');
        $file = fopen('http://licences.ffcorientation.fr/licencesFFCO-OE2010.csv', 'r');

        $output->writeln('Import dans la base de données');

        fgetcsv($file, 0, ";");
        while (($row = fgetcsv($file, 0, ";")) !== false) {
            $this->saveBase($row);
            $this->saveClub($row);
        }

        $this->em->flush();
        $output->writeln('Importations terminées');
    }

    private function saveBase(array $row)
    {
        $base = $this->baseRepository->find($row[self::COLUMN_BASE_ID]);

        if (empty($base)) {
            $base = new Base();
            $base->setId($row[self::COLUMN_BASE_ID]);
        }

        $base
            ->setFirstName(utf8_encode($row[self::COLUMN_FIRST_NAME]))
            ->setLastName(utf8_encode($row[self::COLUMN_LAST_NAME]))
            ->setSI($row[self::COLUMN_SI_NUMBER])
            ->setClub($row[self::COLUMN_CLUB])
        ;

        $this->em->persist($base);
    }

    private function saveClub(array $row)
    {
        $club = $this->clubRepository->find($row[self::COLUMN_CLUB]);

        if (empty($club)) {
            $club = new Club();
            $club->setId($row[self::COLUMN_CLUB]);
        }

        $club
            ->setLabel(utf8_encode($row[self::COLUMN_CLUB_NAME]))
        ;

        $this->em->persist($club);
    }
}
