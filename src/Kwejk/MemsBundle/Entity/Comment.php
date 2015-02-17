<?php
namespace Kwejk\MemsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
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
     * @ORM\ManyToOne(targetEntity="Kwejk\UserBundle\Entity\User", inversedBy="comments")
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;
    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15)
     */
    private $ip;
    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255)
     */
    private $host;
    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255)
     */
    private $userAgent;
    
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
     * @return Comment
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
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }
    /**
     * Set ip
     *
     * @param string $ip
     * @return Comment
     */
    public function setIp($ip)
    {
     if ( isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
    $ip = filter_var($ip, FILTER_VALIDATE_IP);
    $ip = ($ip === false) ? '0.0.0.0' : $ip;
        
        $this->ip = $ip;
        return $this;
    }
    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }
    /**
     * Set host
     *
     * @param string $host
     * @return Comment
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }
    /**
     * Get host
     *
     * @return string 
     */
    public function getHost()
    {
        return $this->host;
    }
    /**
     * Set userAgent
     *
     * @param string $userAgent
     * @return Comment
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        return $this;
    }
    /**
     * Get userAgent
     *
     * @return string 
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
    /**
     * Set createdBy
     *
     * @param \Kwejk\UserBundle\Entity\User $createdBy
     * @return Comment
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
    /**
     * Set mem
     *
     * @param \Kwejk\MemsBundle\Entity\Mem $mem
     * @return Comment
     */
    public function setMem(\Kwejk\MemsBundle\Entity\Mem $mem = null)
    {
        $this->mem = $mem;
        return $this;
    }
    /**
     * Get mem
     *
     * @return \Kwejk\MemsBundle\Entity\Mem 
     */
    public function getMem()
    {
        return $this->mem;
    }
}