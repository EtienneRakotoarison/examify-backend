<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use App\Entity\Student;
use App\Entity\Semester;
use App\Entity\Subject;
use App\Entity\Exam;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Générer des enseignants
        $teachers = [];
        for ($i = 0; $i < 5; $i++) {
            $teacher = new Teacher();
            $teacher->setName($faker->name);
            $teacher->setEmail($faker->unique()->email);
            $teacher->setPassword(md5('teacher_pwd'));
            $manager->persist($teacher);
            $teachers[] = $teacher; // stocker dans un tableau pour association future
        }

        // Générer des étudiants
        $students = [];
        for ($i = 0; $i < 10; $i++) {
            $student = new Student();
            $student->setName($faker->name);
            $student->setEmail($faker->unique()->email);
            $student->setPassword(md5('student_pwd'));
            $manager->persist($student);
            $students[] = $student;
        }

        // Générer des semestres
        $semesters = [];
        for ($i = 0; $i < 3; $i++) {
            $semester = new Semester();
            $semester->setName('Semester ' . ($i + 1));
            $semester->setAcademicYear($faker->year . '/' . ($faker->year + 1));
            $manager->persist($semester);
            $semesters[] = $semester;
        }

        // Générer des matières (Subject)
        $subjects = [];
        foreach ($semesters as $semester) {
            for ($i = 0; $i < 5; $i++) {
                $subject = new Subject();
                $subject->setName($faker->word);
                $subject->setSemester($semester);
                $manager->persist($subject);
                $subjects[] = $subject;
            }
        }

        // Générer des examens
        $exams = [];
        foreach ($subjects as $subject) {
            for ($i = 0; $i < 2; $i++) {
                $exam = new Exam();
                $exam->setTitle($faker->sentence);
                $exam->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', 'now')));
                $exam->setAvailableFrom(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('now', '+1 month')));
                $exam->setAvailability(60); // en minutes
                $exam->setStatus(0); // par défaut à venir
                $exam->setSubject($subject);
                $manager->persist($exam);
                $exams[] = $exam;
            }
        }

        // Générer des questions
        foreach ($exams as $exam) {
            for ($i = 0; $i < 10; $i++) {
                $question = new Question();
                $question->setQuestionText($faker->sentence);
                // Créer un tableau de choix
                $choices = [
                    $faker->sentence,
                    $faker->sentence,
                    $faker->sentence,
                    $faker->sentence
                ];
                $question->setChoices($choices); // stocke le tableau directement
                $question->setCorrectAnswerIndex($faker->numberBetween(0, 3));
                $question->setExam($exam);
                $manager->persist($question);
            }
        }

        // Sauvegarder toutes les données
        $manager->flush();
    }
}
