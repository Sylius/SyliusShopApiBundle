<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Handler\Customer;

use App\Domain\ShopUser\Repository\ShopUserRepository;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\ShopUser;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\ShopApiPlugin\Command\Customer\UpdateCustomer;

final class UpdateCustomerHandler
{
    /** @var RepositoryInterface */
    private $customerRepository;

    /** @var RepositoryInterface */
    private $shopUserRepository;

    public function __construct(
        RepositoryInterface $customerRepository,
        RepositoryInterface $shopUserRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->shopUserRepository = $shopUserRepository;
    }

    public function __invoke(UpdateCustomer $command): void
    {
        /** @var CustomerInterface $customer */
        $customer = $this->customerRepository->findOneBy(['email' => $command->email()]);
        $phoneNumber = str_replace([' ', '-', '(', ')'], '', $command->phoneNumber());

        $customer->setFirstName($command->firstName());
        $customer->setLastName($command->lastName());
        $customer->setGender($command->gender());
        $customer->setBirthday($command->birthday());
        $customer->setPhoneNumber($phoneNumber);
        if ($customer->getUser() instanceof ShopUser){
            /** @var \App\Entity\User\ShopUser $user */
            $user = $customer->getUser();
            $user->setPhoneNumber($phoneNumber);
            $this->shopUserRepository->add($user);

        }
        $customer->setSubscribedToNewsletter($command->subscribedToNewsletter());
        $customer->setMessenger($command->messenger());

        $this->customerRepository->add($customer);
    }
}
