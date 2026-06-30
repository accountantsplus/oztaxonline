<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Appointments Model
 *
 * @package Models
 */
class Tempapp_Model extends CI_Model 
{
    /**
     * Add an appointment record to the database.
     *
     * This method adds a new appointment to the database. If the appointment doesn't exists it is going to be inserted,
     * otherwise the record is going to be updated.
     *
     * @param array $appointment Associative array with the appointment data. Each key has the same name with the
     * database fields.
     *
     * @return int Returns the appointments id.
     */
    public function add($appointment)
    {

        // Perform insert() or update() operation.
        if ( ! isset($appointment['id']))
        {
            $appointment['id'] = $this->_insert($appointment);
        }
        else
        {
            $this->_update($appointment);
        }

        return $appointment['id'];
    }

    /**
     * Check if a particular appointment record already exists.
     *
     * This method checks whether the given appointment already exists in the database. It doesn't search with the id,
     * but by using the following fields: "start_datetime", "end_datetime", "id_users_provider", "id_users_customer",
     * "id_services".
     *
     * @param array $appointment Associative array with the appointment's data. Each key has the same name with the
     * database fields.
     *
     * @return bool Returns whether the record exists or not.
     *
     * @throws Exception If appointment fields are missing.
     */
    public function exists($appointment)
    {
        if ( ! isset($appointment['book_datetime']))
        {
            throw new Exception('Not all appointment field values are provided: '
                . print_r($appointment, TRUE));
        }

        $num_rows = $this->db->get_where('ea_tempappointments', [
            'book_datetime' => $appointment['book_datetime']
        ])
            ->num_rows();

        return ($num_rows > 0) ? TRUE : FALSE;
    }

    /**
     * Insert a new appointment record to the database.
     *
     * @param array $appointment Associative array with the appointment's data. Each key has the same name with the
     * database fields.
     *
     * @return int Returns the id of the new record.
     *
     * @throws Exception If appointment record could not be inserted.
     */
    protected function _insert($appointment)
    {
        $appointment['book_datetime'] = date('Y-m-d H:i:s');
        $appointment['hash'] = $this->generate_hash();

        if ( ! $this->db->insert('ea_tempappointments', $appointment))
        {
            throw new Exception('Could not insert appointment record.');
        }

        return (int)$this->db->insert_id();
    }

    /**
     * Update an existing appointment record in the database.
     *
     * The appointment data argument should already include the record ID in order to process the update operation.
     *
     * @param array $appointment Associative array with the appointment's data. Each key has the same name with the
     * database fields.
     *
     * @throws Exception If appointment record could not be updated.
     */
    protected function _update($appointment)
    {
        $this->db->where('id', $appointment['id']);
        if ( ! $this->db->update('ea_tempappointments', $appointment))
        {
            throw new Exception('Could not update appointment record.');
        }
    }

    /**
     * Find the database id of an appointment record.
     *
     * The appointment data should include the following fields in order to get the unique id from the database:
     * "start_datetime", "end_datetime", "id_users_provider", "id_users_customer", "id_services".
     *
     * IMPORTANT: The record must already exists in the database, otherwise an exception is raised.
     *
     * @param array $appointment Array with the appointment data. The keys of the array should have the same names as
     * the db fields.
     *
     * @return int Returns the db id of the record that matches the appointment data.
     *
     * @throws Exception If appointment could not be found.
     */
    public function find_record_id($appointment)
    {
        $this->db->where([
            'book_datetime' => $appointment['book_datetime']
        ]);

        $result = $this->db->get('ea_tempappointments');

        if ($result->num_rows() == 0)
        {
            throw new Exception('Could not find appointment record id.');
        }

        return $result->row()->id;
    }

    /**
     * Delete an existing appointment record from the database.
     *
     * @param int $appointment_id The record id to be deleted.
     *
     * @return bool Returns the delete operation result.
     *
     * @throws Exception If $appointment_id argument is invalid.
     */
    public function delete($appointment_id)
    {
        if ( ! is_numeric($appointment_id))
        {
            throw new Exception('Invalid argument type $appointment_id (value:"' . $appointment_id . '")');
        }

        $num_rows = $this->db->get_where('ea_tempappointments', ['id' => $appointment_id])->num_rows();

        if ($num_rows == 0)
        {
            return FALSE; // Record does not exist.
        }

        $this->db->where('id', $appointment_id);
        return $this->db->delete('ea_tempappointments');
    }

    /**
     * Get a specific row from the appointments table.
     *
     * @param int $appointment_id The record's id to be returned.
     *
     * @return array Returns an associative array with the selected record's data. Each key has the same name as the
     * database field names.
     *
     * @throws Exception If $appointment_id argumnet is invalid.
     */
    public function get_row($appointment_id)
    {
        if ( ! is_numeric($appointment_id))
        {
            throw new Exception('Invalid argument given. Expected integer for the $appointment_id: '
                . $appointment_id);
        }

        return $this->db->get_where('ea_tempappointments', ['id' => $appointment_id])->row_array();
    }

    /**
     * Get a specific field value from the database.
     *
     * @param string $field_name The field name of the value to be returned.
     * @param int $appointment_id The selected record's id.
     *
     * @return string Returns the records value from the database.
     *
     * @throws Exception If $appointment_id argument is invalid.
     * @throws Exception If $field_name argument is invalid.
     * @throws Exception If requested appointment record was not found.
     * @throws Exception If requested field name does not exist.
     */
    public function get_value($field_name, $appointment_id)
    {
        if ( ! is_numeric($appointment_id))
        {
            throw new Exception('Invalid argument given, expected integer for the $appointment_id: '
                . $appointment_id);
        }

        if ( ! is_string($field_name))
        {
            throw new Exception('Invalid argument given, expected  string for the $field_name: ' . $field_name);
        }

        if ($this->db->get_where('ea_tempappointments', ['id' => $appointment_id])->num_rows() == 0)
        {
            throw new Exception('The record with the provided id '
                . 'does not exist in the database: ' . $appointment_id);
        }

        $row_data = $this->db->get_where('ea_tempappointments', ['id' => $appointment_id])->row_array();

        if ( ! isset($row_data[$field_name]))
        {
            throw new Exception('The given field name does not exist in the database: ' . $field_name);
        }

        return $row_data[$field_name];
    }

    /**
     * Get all, or specific records from appointment's table.
     *
     * @example $this->Model->getBatch('id = ' . $recordId);
     *
     * @param string $where_clause (OPTIONAL) The WHERE clause of the query to be executed. DO NOT INCLUDE 'WHERE'
     * KEYWORD.
     *
     * @param bool $aggregates (OPTIONAL) Defines whether to add aggregations or not.
     *
     * @return array Returns the rows from the database.
     */
    public function get_batch($where_clause = '', $aggregates = FALSE)
    {
        if ($where_clause != '')
        {
            $this->db->where($where_clause);
        }

        $appointments = $this->db->get('ea_tempappointments')->result_array();

        if ($aggregates)
        {
            foreach ($appointments as &$appointment)
            {
                $appointment = $this->get_aggregates($appointment);
            }
        }

        return $appointments;
    }

    /**
     * Generate a unique hash for the given appointment data.
     *
     * This method uses the current date-time to generate a unique hash string that is later used to identify this
     * appointment. Hash is needed when the email is send to the user with an edit link.
     *
     * @return string Returns the unique appointment hash.
     */
    public function generate_hash()
    {
        $current_date = new DateTime();
        return md5($current_date->getTimestamp());
    }
}
