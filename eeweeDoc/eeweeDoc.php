<?php
/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class EeweeDoc extends Module
{
    private $id_product = 59;

    public function __construct()
    {
        $this->name = 'eeweeDoc';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'eewee.fr';
        $this->need_instance = 1;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Documentation for PrestaShop class');
        $this->description = $this->l('Description PrestaShop class and example');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall my module ?');
    }
    public function install()
    {
        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader');
    }
    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        //echo '<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>';

        //----------------------------------------------------
        // CLASS PRODUCT
        //----------------------------------------------------

        // ADD/UPDATE PRODUCT
        //$this->eeweeProductAddOrUpdate();

        // ADD PRODUCT
        //$this->eeweeProductAdd();

        // UPDATE PRODUCT
        //$this->eeweeProductUpdate();

        // ADD CATEGORY
        //$this->eeweeProductAddCateg();

        // UPDATE CATEGORY
        $this->eeweeProductUpdateCateg();

        //----------------------------------------------------
        // CLASS XXX
        //----------------------------------------------------

        // ...

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
        return $output;
    }

    /**
     * Add or update product
     */
    private function eeweeProductAddOrUpdate()
    {
        $langs = $this->getLang();

        // INSERT (0 attribut a votre fonction)
        //$p = new Product();
        // UPDATE (1 attribut a votre fonction : id_product)
        $p = new Product(58);

        // LANG
        foreach ($langs as $lang) {
            // INFORMATIONS
            $p->name[ $lang['id_lang'] ] = 'Nom du produit';
            // REFERENCEMENT - SEO
            $p->link_rewrite[ $lang['id_lang'] ] = 'nom-du-produit';
        }

        // INFORMATIONS
            $p->is_virtual = false;             // Produit dematerialise (services, reservations, produits telechargeables, etc.)
            $p->reference = '5512';             // Reference
            $p->ean13 = '0123456789012';        // Code-barres EAN-13 ou JAN
            $p->upc = '012345678901';           // Code-barres UPC
            $p->active = false;                 // Active
            $p->redirect_type = '302';          // Rediriger lorsqu'inactif (valeur possible : 404, 301, 302)
            //$p->id_product_redirected = '59'; // Produit associe (=id_produit d'un autre produit a associer)
            $p->visibility = 'both';            // Visibilite (valeur possible : both, catalog, search, none)
            $p->online_only = false;            // Exclusivite web (non vendu en magasin)
            $p->show_price = true;              // Afficher le prix
            $p->new = true;                     // A verifier
            $p->condition = 'used';             // Etat (valeur possible : new, used, refurbished)
            $p->description_short = 'Resume du produit.';       // Resume
            $p->description = 'Description longue du produit.'; // Description
            //$p->tags = '';                    // A verifier

        // PRIX
            // PRIX DU PRODUIT
            $p->wholesale_price = 10;           // Prix d'achat HT
            $p->price = 20;                     // Prix de vente HT
            $p->id_tax_rules_group = 2;         // Regle de taxe (id de la taxe)
            //Calcul automatique HT + TVA       // Prix de vente TTC
            $p->unit_price = 7;                 // Prix unitaire HT
            $p->unity = 'Bouteille';            // par
            $p->on_sale = true;                 // Afficher un bandeau "Promo !" sur la page produit ainsi qu'en texte sur la page catégories.

            // PRIX SPECIFIQUE
            $p->specificPrice = 8;              // A verifier

        // REFERENCEMENT - SEO
            $p->meta_title = 'Meta title eewee.fr';
            $p->meta_description = 'Meta description eewee.fr';
            //$p->meta_keywords = 'meta, keywords, eewee';

        // ASSOCIATIONS
            //$p->category = 2;                   // A verifier
            $p->id_category_default = 2;        // Ajouter l'id de la categorie par defaut en table
            //$p->manufacturer_name = '';
            $p->id_manufacturer = 1;            // Fabricant

        // LIVRAISON
            $p->width = 10;                     // Largeur du colis
            $p->height = 20;                    // Hauteur du colis
            $p->depth = 30;                     // Profondeur du colis
            $p->weight = 40;                    // Poids du colis
            $p->additional_shipping_cost = 50;  // Frais de port supplementaire (par unite)

        // DECLINAISONS
            //$p->minimal_quantity = 12;          // Quantite minimale
            //$p->available_date = '2016-01-15';  // Date de disponibilite

        // QUANTITES
            // QUANTITES DISPONIBLES A LA VENTE
            $p->quantity = 15;                  // A verifier

            // PARAMETRES DE DISPONIBILITE
            $p->minimal_quantity = 12;          // Quantite minimale
            $p->available_now = 'Produit en stock.';                            // Message si produit en stock
            $p->available_later = 'Produit hors stock (precommande possible).'; // Message si produit en rupture de stock mais precommande autorisee
            $p->available_date = '2016-01-15';  // Date de disponibilite

        // IMAGES

        // CARACTERISTIQUES

        // PERSONNALISATION
            //$p->uploadable_files = 1;           // Nombre de champ d'upload souhaite
            //$p->text_fields = 2;                // Nombre de champ texte souhaite

        // DOCUMENTS JOINTS

        // FOURNISSEURS
            //$p->id_supplier = 2;                // Ajouter l'id du fournisseur dans la table
            //$p->supplier_reference = 3;
            //$p->supplier_name = '';

        // AUTRES
            //$p->id_shop_default = 1;
            //$p->tax_name = '';
            //$p->tax_rate = '';
            //$p->unit_price_ratio = '';
            //$p->ecotax = true;
            //$p->location = '';
            //$p->quantity_discount = false;
            //$p->customizable = '';
            //$p->available_for_order = '';
            //$p->indexed = 0;
            //$p->date_add = '2016-01-15';
            //$p->date_upd = '2016-01-16';
            //$p->base_price = '';
            //$p->id_color_default = 0;
            //$p->advanced_stock_management = '';
            //$p->out_of_stock = '';
            //$p->depends_on_stock = '';
            //$p->isFullyLoaded = '';
            //$p->cache_is_pack = '';
            //$p->cache_has_attachments = '';
            //$p->id_pack_product_attribute = '';
            //$p->cache_default_attribute = '';
            //$p->pack_stock_type = '';

        $p->save();
    }

    /**
     * Add product
     */
    private function eeweeProductAdd()
    {
        $p = new Product();

        // LANG
        $langs = $this->getLang();
        foreach ($langs as $lang) {
            // INFORMATIONS
            $p->name[$lang['id_lang']] = 'Nom du produit';
            // REFERENCEMENT - SEO
            $p->link_rewrite[$lang['id_lang']] = 'nom-du-produit';
        }

        // INFORMATIONS
        $p->reference = '5512';             // Reference
        $p->active = true;                  // Active
        $p->description_short = 'Resume du produit.';       // Resume
        $p->description = 'Description longue du produit.'; // Description

        // PRIX
        $p->price = 20;                     // Prix de vente HT

        // INSERT
        $p->add();
    }

    /**
     * Update product
     */
    private function eeweeProductUpdate()
    {
        $p = new Product(59);

        // LANG
        $langs = $this->getLang();
        foreach ($langs as $lang) {
            // INFORMATIONS
            $p->name[$lang['id_lang']] = 'Nom du produit';
            // REFERENCEMENT - SEO
            $p->link_rewrite[$lang['id_lang']] = 'nom-du-produit';
        }

        // INFORMATIONS
        $p->reference = '5510';             // Reference
        $p->active = false;                 // Active
        $p->description_short = 'Resume du produit.';       // Resume
        $p->description = 'Description longue du produit.'; // Description

        // PRIX
        $p->price = 18;                     // Prix de vente HT

        // UPDATE
        $p->update();
    }

    /**
     * Add categorie
     */
    private function eeweeProductAddCateg()
    {
        $p = new Product( $this->id_product );
        $p->addToCategories(array(2, 3, 4));
    }

    /**
     * Update categorie
     */
    private function eeweeProductUpdateCateg()
    {
        $p = new Product( $this->id_product );
        $p->updateCategories(array(2, 3));
    }





    /**
     * Get all languages
     *
     * @return array
     */
    private function getLang()
    {
        return LanguageCore::getLanguages();
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }
}
