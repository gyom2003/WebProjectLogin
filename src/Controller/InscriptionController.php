<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'inscription_page')]
    public function inscriptionAction(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

            if ($existingUser) {
                return $this->render('inscription.html.twig', [
                    'message' => 'Utilisateur déjà pris. Veuillez choisir un autre nom d\'utilisateur.'
                ]);
            } else {
                $user = new User();
                $user->setUsername($username);
                // $user->setPassword($password);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->render('inscription.html.twig', [
                    'message' => 'Compte créé avec succès!'
                ]);
            }
        }

        return $this->render('inscription.html.twig', [
            'message' => ''
        ]);
    }
}
