<?php
class JobeetTestFunctional extends sfTestFunctional
{
  public function loadData()
  {
    $loader = new sfPropelData();
    $loader->loadData(sfConfig::get('sf_test_dir').'/fixtures');

    return $this;
  }

  public function getMostRecentProgrammingJob()
  {
    // programming カテゴリの最新の求人
    $criteria = new Criteria();
    $criteria->add(JobeetCategoryPeer::SLUG, 'programming');
    $category = JobeetCategoryPeer::doSelectOne($criteria);

    $criteria = new Criteria();
    $criteria->add(JobeetJobPeer::EXPIRES_AT, time(), Criteria::GREATER_THAN);
    $criteria->add(JobeetJobPeer::CATEGORY_ID, $category->getId());
    $criteria->addDescendingOrderByColumn(JobeetJobPeer::CREATED_AT);

    return JobeetJobPeer::doSelectOne($criteria);
  }

}