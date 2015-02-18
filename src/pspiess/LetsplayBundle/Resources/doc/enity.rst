Good Video on How to create a ManyToMany Mapping Relation

https://www.youtube.com/watch?v=akV4D7cq4UQ
4. How to Create a ManyToMany Relationship with Doctrine2 & Symfony2

Infos http://symfony.com/doc/current/book/doctrine.html
--------------------------------------------------------------------------------
generate Entities -->
    doctrine:generate:entities pspiessLetsplayBundle:Field
    doctrine:generate:entities pspiessLetsplayBundle:Price
    doctrine:generate:entities pspiessLetsplayBundle:Booking

    Es ist besser die enties einzeln zu erstellen, sonst könnten ungewollt
    andere entities erstellt werden.

Mapping Information anzeigen -->
    doctrine:mapping:info

Ganz wichtig sind die ORM notationen, sonst wird nichts erkannt.
Z.B. * @ORM\Column(type="text", nullable=true, name="note")

Probleme bei ManyToOne Beziehungen, wenn die id von der Parent Tabelle nicht abgespeichert wird!
Fehlt wahrscheinlich beim add eine Zeile
Beispiel:

    public function addInvoicepos(\pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos)
    {
        $this->invoicepos[] = $invoicepos;
        $invoicepos->setInvoice($this); //Das fehlt !!!!!
        return $this;
    }
//Wichtig für JavaScript Routes
https://github.com/FriendsOfSymfony/FOSJsRoutingBundle/blob/master/Resources/doc/index.md


$entPayoffice = $em->getRepository('pspiessLetsplayBundle:Payoffice')->find(1);
    --> Gibt die Entity zurück mit den child entities
$entPayoffice2 = $em->getRepository('pspiessLetsplayBundle:Payoffice')->findall();
    --> Gibt ein Array mit Entities zurück!