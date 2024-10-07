<?php

namespace App\Controller;

use App\Entity\Teacher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TeacherController extends AbstractController
{
    private $entityManager;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * Methode API pour faire le login teacher
     * 
     * Example de test:
        {
            "email": "hahn.douglas@yahoo.com",
            "password": "teacher_pwd"
        }
     */
    #[Route("/api/teachers/login", name: "teacher_login", methods: ["POST"])]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (is_null($email) || is_null($password)) {
            return new JsonResponse(['message' => 'Email et mot de passe requis.'], Response::HTTP_BAD_REQUEST);
        }
        $teacher = $this->entityManager->getRepository(Teacher::class)->findOneBy(['email' => $email]);
        if (is_null($teacher) || md5($password) !== $teacher->getPassword()) {
            return new JsonResponse(['message' => 'Identifiants invalides.'], Response::HTTP_UNAUTHORIZED);
        }

        $data = $this->serializer->serialize($teacher, 'json', ['groups' => ['teacher:read']]);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
