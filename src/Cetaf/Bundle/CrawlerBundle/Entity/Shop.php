<?php

namespace Cetaf\Bundle\CrawlerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Shop
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cetaf\Bundle\CrawlerBundle\Entity\ShopRepository")
 */
class Shop
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="shopName", type="string", length=255)
     */
    private $shopName;

    /**
     * @var string
     *
     * @ORM\Column(name="shopAdress", type="string", length=255)
     */
    private $shopAdress;

    /**
     * @var string
     *
     * @ORM\Column(name="shopPhoneNumber", type="string", length=255)
     */
    private $shopPhoneNumber;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set shopName
     *
     * @param  string $shopName
     * @return Shop
     */
    public function setShopName($shopName)
    {
        $this->shopName = $shopName;

        return $this;
    }

    /**
     * Get shopName
     *
     * @return string
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * Set shopAdress
     *
     * @param  string $shopAdress
     * @return Shop
     */
    public function setShopAdress($shopAdress)
    {
        $this->shopAdress = $shopAdress;

        return $this;
    }

    /**
     * Get shopAdress
     *
     * @return string
     */
    public function getShopAdress()
    {
        return $this->shopAdress;
    }

    /**
     * Set shopPhoneNumber
     *
     * @param  string $shopPhoneNumber
     * @return Shop
     */
    public function setShopPhoneNumber($shopPhoneNumber)
    {
        $this->shopPhoneNumber = $shopPhoneNumber;

        return $this;
    }

    /**
     * Get shopPhoneNumber
     *
     * @return string
     */
    public function getShopPhoneNumber()
    {
        return $this->shopPhoneNumber;
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Shop
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Shop
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
