Good Video on How to create a ManyToMany Mapping Relation

https://www.youtube.com/watch?v=akV4D7cq4UQ
4. How to Create a ManyToMany Relationship with Doctrine2 & Symfony2

--------------------------------------------------------------------------------
generate Entities -->
    doctrine:generate:entities pspiessLetsplayBundle:Field
    doctrine:generate:entities pspiessLetsplayBundle:Price

    Es ist besser die enties einzeln zu erstellen, sonst könnten ungewollt
    andere entities erstellt werden.

Mapping Information anzeigen -->
    doctrine:mapping:info