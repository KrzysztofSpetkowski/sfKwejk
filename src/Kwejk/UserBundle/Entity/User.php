<?php
namespace Kwejk\UserBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Kwejk\MemsBundle\Entity\Mem", mappedBy="createdBy")
     * @var ArrayCollection
     */
    private $mems;
    
    /**
     * @ORM\OneToMany(targetEntity="Kwejk\MemsBundle\Entity\Comment", mappedBy="createdBy")
     * @var ArrayCollection
     */
    private $commnets;
    
    /**
     * @ORM\OneToMany(targetEntity="Kwejk\MemsBundle\Entity\Rating", mappedBy="createdBy")
     * @var ArrayCollection
     */
    private $ratings;
    
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
     * Constructor
     */
    public function __construct()
    {
    	parent::__construct();
    	
    	
    	$this->roles = ['ROLE_USER'];
    	
        $this->mems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commnets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add mems
     *
     * @param \Kwejk\MemsBundle\Entity\Mem $mems
     * @return User
     */
    public function addMem(\Kwejk\MemsBundle\Entity\Mem $mems)
    {
        $this->mems[] = $mems;
        return $this;
    }
    /**
     * Remove mems
     *
     * @param \Kwejk\MemsBundle\Entity\Mem $mems
     */
    public function removeMem(\Kwejk\MemsBundle\Entity\Mem $mems)
    {
        $this->mems->removeElement($mems);
    }
    /**
     * Get mems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMems()
    {
        return $this->mems;
    }
    /**
     * Add commnets
     *
     * @param \Kwejk\MemsBundle\Entity\Comment $commnets
     * @return User
     */
    public function addCommnet(\Kwejk\MemsBundle\Entity\Comment $commnets)
    {
        $this->commnets[] = $commnets;
        return $this;
    }
    /**
     * Remove commnets
     *
     * @param \Kwejk\MemsBundle\Entity\Comment $commnets
     */
    public function removeCommnet(\Kwejk\MemsBundle\Entity\Comment $commnets)
    {
        $this->commnets->removeElement($commnets);
    }
    /**
     * Get commnets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommnets()
    {
        return $this->commnets;
    }
    /**
     * Add ratings
     *
     * @param \Kwejk\MemsBundle\Entity\Rating $ratings
     * @return User
     */
    public function addRating(\Kwejk\MemsBundle\Entity\Rating $ratings)
    {
        $this->ratings[] = $ratings;
        return $this;
    }
    /**
     * Remove ratings
     *
     * @param \Kwejk\MemsBundle\Entity\Rating $ratings
     */
    public function removeRating(\Kwejk\MemsBundle\Entity\Rating $ratings)
    {
        $this->ratings->removeElement($ratings);
    }
    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRatings()
    {
        return $this->ratings;
    }
}