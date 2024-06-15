<?php

/**
 * Class permissionModel represents a model for managing permissions.
 */
class PermissionModel extends Mysql
{
	/** @var int|null The permission ID. */
	public $id_permission;
	/** @var int|null The role ID. */
	public $intRolid;
	/** @var int|null The module ID. */
	public $intModuleid;
	/** @var int|null Read permission. */
	public $r;
	/** @var int|null Write permission. */
	public $w;
	/** @var int|null Update permission. */
	public $u;
	/** @var int|null Delete permission. */
	public $d;

	/**
	 * Constructor for PermissionsModel.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Retrieves all active modules.
	 *
	 * @return array An array of active modules.
	 */

	public function selectModules()
	{
		$sql = "SELECT * 
				FROM `modules` 
				WHERE status != 0";
		return $this->select_all($sql);
	}


	/**
	 * Retrieves permissions for a specific role.
	 *
	 * @param int $id_rol Role ID
	 * @return array An array of permissions for the given role.
	 */

	public function selectPermissions(int $id_rol)
	{
		$this->id_permission = $id_rol;
		$sql = "SELECT * 
				FROM `permissions` 
				WHERE rol_id = $this->id_permission";
		return $this->select($sql);
	}


	/**
	 * Deletes permissions for a specific role.
	 *
	 * @param int $id_rol Role ID
	 * @return bool True if permissions were successfully deleted, false otherwise.
	 */
	public function deletePermissions(int $id_rol)
	{
		$this->intRolid = $id_rol;
		$sql = "DELETE 
				FROM Permissions 
				WHERE rol_id = $this->intRolid";
		return $this->delete($sql);
	}

	/**
	 * Inserts permissions for a role and module.
	 *
	 * @param int $id_rol Role ID
	 * @param int $id_modulo Module ID
	 * @param int $r Read permission
	 * @param int $w Write permission
	 * @param int $u Update permission
	 * @param int $d Delete permission
	 * @return bool True if permissions were successfully inserted, false otherwise.
	 */
	public function insertPermissions(
		int $id_rol,
		int $id_module,
		int $r,
		int $w,
		int $u,
		int $d
	) {
		$this->intRolid = $id_rol;
		$this->intModuleid = $id_module;
		$query_insert = "INSERT 
						INTO permissions(rol_id,module_id, r, w, u, d) 
						VALUES(?, ?, ?, ?, ?, ?)";
		$arrData = array($this->intRolid, $this->intModuleid, $r, $w, $u, $d);
		return $this->insert($query_insert, $arrData);
	}

	/**
	 * Retrieves permissions for modules associated with a role.
	 *
	 * @param int $id_rol Role ID
	 * @return array An associative array where keys are module IDs and values are permission details.
	 */
	public function PermissionsModules(int $id_rol)
	{
		$this->intRolid = $id_rol;
		$sql = "SELECT  p.rol_id,
                        p.module_id,
                        m.name_module,
                        p.r,
                        p.w,
                        p.u,
                        p.d
                FROM permissions p
                INNER JOIN modules m 
				ON p.module_id = m.id_modules
                WHERE p.rol_id = $this->intRolid";

		$request = $this->select_all($sql);

		$arrPermissions = array();
		foreach ($request as $row) {
			$arrPermissions[$row['module_id']] = $row;
		}

		return $arrPermissions;
	}
}
