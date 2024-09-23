<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserManager
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ){
    }

    public function findAll(): array
    {
        return $this->userRepository->findAll();
    }

    public function createUserFromAdmin(User $user, string $plainPassword): void
    {
        $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));

        $this->em->persist($user);
        $this->em->flush();
    }

    public function updateUserFromAdmin(User $user, string $plainPassword): void
    {
        $user->setPassword($this->passwordHasher->hashPassword($user, $plainPassword));

        $this->em->persist($user);
        $this->em->flush();
    }

    public function deleteUser(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }
}