<?php

namespace App\Interfaces;


interface CanManageAssetInterface {}

interface CanManageLinkInterface {}

interface CanRemoveInterface {}


interface Client extends
    CanRemoveInterface,
    CanManageLinkInterface,
    CanManageLinkInterface {}