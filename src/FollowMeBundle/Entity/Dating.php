<?php

namespace FollowMeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dating
 *
 * @ORM\Table(name="dating", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Dating
{
    /**
     * @var string
     *
     * @ORM\Column(name="dat_title", type="string", length=64, nullable=false)
     */
    private $datTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="dat_description", type="text", length=65535, nullable=false)
     */
    private $datDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="dat_start", type="integer", nullable=false)
     */
    private $datStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="dat_end", type="integer", nullable=false)
     */
    private $datEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="dat_lat", type="integer", nullable=false)
     */
    private $datLat;

    /**
     * @var integer
     *
     * @ORM\Column(name="dat_lng", type="integer", nullable=false)
     */
    private $datLng;

    /**
     * @var string
     *
     * @ORM\Column(name="dat_href", type="string", length=64, nullable=false)
     */
    private $datHref;

    /**
     * @var string
     *
     * @ORM\Column(name="dat_link_title", type="string", length=64, nullable=false)
     */
    private $datLinkTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="dat_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $datId;

    /**
     * @var \FollowMeBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FollowMeBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Set datTitle
     *
     * @param string $datTitle
     *
     * @return Dating
     */
    public function setDatTitle($datTitle)
    {
        $this->datTitle = $datTitle;

        return $this;
    }

    /**
     * Get datTitle
     *
     * @return string
     */
    public function getDatTitle()
    {
        return $this->datTitle;
    }

    /**
     * Set datDescription
     *
     * @param string $datDescription
     *
     * @return Dating
     */
    public function setDatDescription($datDescription)
    {
        $this->datDescription = $datDescription;

        return $this;
    }

    /**
     * Get datDescription
     *
     * @return string
     */
    public function getDatDescription()
    {
        return $this->datDescription;
    }

    /**
     * Set datStart
     *
     * @param integer $datStart
     *
     * @return Dating
     */
    public function setDatStart($datStart)
    {
        $this->datStart = $datStart;

        return $this;
    }

    /**
     * Get datStart
     *
     * @return integer
     */
    public function getDatStart()
    {
        return $this->datStart;
    }

    /**
     * Set datEnd
     *
     * @param integer $datEnd
     *
     * @return Dating
     */
    public function setDatEnd($datEnd)
    {
        $this->datEnd = $datEnd;

        return $this;
    }

    /**
     * Get datEnd
     *
     * @return integer
     */
    public function getDatEnd()
    {
        return $this->datEnd;
    }

    /**
     * Set datLat
     *
     * @param integer $datLat
     *
     * @return Dating
     */
    public function setDatLat($datLat)
    {
        $this->datLat = $datLat;

        return $this;
    }

    /**
     * Get datLat
     *
     * @return integer
     */
    public function getDatLat()
    {
        return $this->datLat;
    }

    /**
     * Set datLng
     *
     * @param integer $datLng
     *
     * @return Dating
     */
    public function setDatLng($datLng)
    {
        $this->datLng = $datLng;

        return $this;
    }

    /**
     * Get datLng
     *
     * @return integer
     */
    public function getDatLng()
    {
        return $this->datLng;
    }

    /**
     * Set datHref
     *
     * @param string $datHref
     *
     * @return Dating
     */
    public function setDatHref($datHref)
    {
        $this->datHref = $datHref;

        return $this;
    }

    /**
     * Get datHref
     *
     * @return string
     */
    public function getDatHref()
    {
        return $this->datHref;
    }

    /**
     * Set datLinkTitle
     *
     * @param string $datLinkTitle
     *
     * @return Dating
     */
    public function setDatLinkTitle($datLinkTitle)
    {
        $this->datLinkTitle = $datLinkTitle;

        return $this;
    }

    /**
     * Get datLinkTitle
     *
     * @return string
     */
    public function getDatLinkTitle()
    {
        return $this->datLinkTitle;
    }

    /**
     * Get datId
     *
     * @return integer
     */
    public function getDatId()
    {
        return $this->datId;
    }

    /**
     * Set user
     *
     * @param \FollowMeBundle\Entity\User $user
     *
     * @return Dating
     */
    public function setUser(\FollowMeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \FollowMeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
