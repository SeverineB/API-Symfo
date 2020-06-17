<?php
declare(strict_types=1);

namespace App\Domain\User\Model;

/**
 * @ORM\Entity()
 */
class User extends DomainModel implements UserInterface
{
    const EVENT_PASSWORD_CHANGED = 'password_changed';
    const EVENT_PREPARE_REGISTRATION = 'prepare_registration';
    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $registrationToken;

    /**
     * Encoded password
     * @ORM\Column(type="string")
     * @var string
     */
    private $password;

    /**
     * Encoded password
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $emailVerified;

    public function __construct(string $email, string $plainPassword)
    {
        $this->email = $email;
        $this->emailVerified = false;
        $this->setPlainPassword($plainPassword);
    }

    public function setPlainPassword(string $plainPassword): void
    {
        if (empty($plainPassword)) {
            return;
        }

        // Ce callback est executé dans le context de cette classe et vient renseigner directement le password encrypté
        // Le mot de passe clair de l'utilisateur n'est présent que dans l'événement ci-dessous et n'est stocké nul part ailleurs
        $event               = new PasswordChanged($this, $plainPassword, function ($password) {
            $this->password = $password;
        });
        $this->dispatch($event, self::EVENT_PASSWORD_CHANGED);
    }

    public function prepareRegistration(): void
    {
        $this->registrationToken = base64_encode(\random_bytes(30));
        $this->dispatch(new Register($this, $this->registrationToken), self::EVENT_PREPARE_REGISTRATION);
    }
    
    // Getters ...
}