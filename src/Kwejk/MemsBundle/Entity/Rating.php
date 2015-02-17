<?php
namespace Kwejk\MemsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Rating
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity(repositoryClass="Kwejk\MemsBundle\Entity\RatingRepository")
 */
class Rating
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;
    
    /**
     * @ORM\ManyToOne(targetEntity="Kwejk\UserBundle\Entity\User", inversedBy="ratings")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;
    
    /**
     * @ORM\ManyToOne(targetEntity="Mem", inversedBy="comments")
     * @ORM\JoinColumn(name="mem_id", referencedColumnName="id")
     * @var Mem
     */
    private $mem;
    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="smallint")
     */
    private $rating;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Rating
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
    /**
     * Set rating
     *
     * @param integer $rating
     * @return Rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }
    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }
    
    /**
     * Set mem
     *
     * @param  $mem
     * @return Rating
     */
    public function setMem($mem)
    {
        $this->mem = $mem;
        return $this;
    }
    /**
     * Get mem
     *
     * @return string
     */
    public function getMem()
    {
        return $this->mem;
    }
        
    /**
     * Set createdBy
     *
     * @param \Kwejk\UserBundle\Entity\User $createdBy
     * @return Rating
     */
    public function setCreatedBy(\Kwejk\UserBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;
        return $this;
    }
    /**
     * Get createdBy
     *
     * @return \Kwejk\UserBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}