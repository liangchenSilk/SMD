<?php
/**
 * Created by PhpStorm.
 * User: joshcarter
 * Date: 20/06/2016
 * Time: 13:37
 */

class Webtise_Gallery_Block_Adminhtml_Gallery_Helper_Categories_Content extends Mage_Adminhtml_Block_Catalog_Category_Tree
{

    protected $_categoryIds = null;
    protected $_selectedNodes = null;

    public function __construct() {
        parent::__construct();
        $this->setTemplate('webtise/gallery/helper/categories.phtml');
        $this->_withProductCount = false;
    }

    public function getGallery() {
        return Mage::registry('current_gallery');
    }

    public function getCategoryIds() {
        if($this->getGallery()->getCategoryIds() == null) {
            return array();
        } else {
            return explode(',', $this->getGallery()->getCategoryIds());
        }
    }

    public function getIdsString(){
        return implode(',', $this->getCategoryIds());
    }

    public function getRootNode(){
        $root = $this->getRoot();
        if ($root && in_array($root->getId(), $this->getCategoryIds())) {
            $root->setChecked(true);
        }
        return $root;
    }

    public function getRoot($parentNodeCategory = null, $recursionLevel = 3){
        if (!is_null($parentNodeCategory) && $parentNodeCategory->getId()) {
            return $this->getNode($parentNodeCategory, $recursionLevel);
        }
        $root = Mage::registry('category_root');
        if (is_null($root)) {
            $rootId = Mage_Catalog_Model_Category::TREE_ROOT_ID;
            $ids = $this->getSelectedCategotyPathIds($rootId);
            $tree = Mage::getResourceSingleton('catalog/category_tree')
                ->loadByIds($ids, false, false);
            if ($this->getCategory()) {
                $tree->loadEnsuredNodes($this->getCategory(), $tree->getNodeById($rootId));
            }
            $tree->addCollectionData($this->getCategoryCollection());
            $root = $tree->getNodeById($rootId);
            Mage::register('category_root', $root);
        }
        return $root;
    }

    protected function _getNodeJson($node, $level = 1){
        $item = parent::_getNodeJson($node, $level);
        if ($this->_isParentSelectedCategory($node)) {
            $item['expanded'] = true;
        }
        if (in_array($node->getId(), $this->getCategoryIds())) {
            $item['checked'] = true;
        }
        return $item;
    }

    protected function _isParentSelectedCategory($node){
        $result = false;
        // Contains string with all category IDs of children (not exactly direct) of the node
        $allChildren = $node->getAllChildren();
        if ($allChildren) {
            $selectedCategoryIds = $this->getCategoryIds();
            $allChildrenArr = explode(',', $allChildren);
            for ($i = 0, $cnt = count($selectedCategoryIds); $i < $cnt; $i++) {
                $isSelf = $node->getId() == $selectedCategoryIds[$i];
                if (!$isSelf && in_array($selectedCategoryIds[$i], $allChildrenArr)) {
                    $result = true;
                    break;
                }
            }
        }
        return $result;
    }

    protected function _getSelectedNodes(){
        if ($this->_selectedNodes === null) {
            $this->_selectedNodes = array();
            $root = $this->getRoot();
            foreach ($this->getCategoryIds() as $categoryId) {
                if ($root) {
                    $this->_selectedNodes[] = $root->getTree()->getNodeById($categoryId);
                }
            }
        }
        return $this->_selectedNodes;
    }

    public function getCategoryChildrenJson($categoryId){
        $category = Mage::getModel('catalog/category')->load($categoryId);
        $node = $this->getRoot($category, 1)->getTree()->getNodeById($categoryId);
        if (!$node || !$node->hasChildren()) {
            return '[]';
        }
        $children = array();
        foreach ($node->getChildren() as $child) {
            $children[] = $this->_getNodeJson($child);
        }
        return Mage::helper('core')->jsonEncode($children);
    }

    public function getLoadTreeUrl($expanded = null){
        return $this->getUrl('*/*/categoriesJson', array('_current' => true));
    }

    public function getSelectedCategoryPathIds($rootId = false){
        $ids = array();
        $categoryIds = $this->getCategoryIds();
        if (empty($categoryIds)) {
            return array();
        }
        $collection = Mage::getResourceModel('catalog/category_collection');
        if ($rootId) {
            $collection->addFieldToFilter('parent_id', $rootId);
        }
        else {
            $collection->addFieldToFilter('entity_id', array('in'=>$categoryIds));
        }

        foreach ($collection as $item) {
            if ($rootId && !in_array($rootId, $item->getPathIds())) {
                continue;
            }
            foreach ($item->getPathIds() as $id) {
                if (!in_array($id, $ids)) {
                    $ids[] = $id;
                }
            }
        }
        return $ids;
    }

}