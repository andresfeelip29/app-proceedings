<?php

interface IRepository
{

    public function save($entity);
    public function getAll();
    public function get($id);
    public function delete($id);
    public function update($entity);
}
