<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBshafferOAuthTables extends Migration
{
    public function up()
    {
        // Таблица oauth_clients
        if (!$this->db->tableExists('oauth_clients')) {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => FALSE,
                    'auto_increment' => TRUE
                ],
                'client_id' => [
                    'type' => 'VARCHAR',
                    'null' => FALSE
                ],
                'client_secret' => [
                    'type' => 'VARCHAR',
                    'null' => FALSE
                ],
                'redirect_uri' => [
                    'type' => 'VARCHAR',
                    'null' => TRUE
                ],
                'grant_types' => [
                    'type' => 'VARCHAR',
                    'null' => TRUE
                ],
                'scope' => [
                    'type' => 'VARCHAR',
                    'null' => TRUE
                ],
                'user_id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => TRUE
                ]
            ]);
            
            $this->forge->addKey('id', TRUE);
            $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
            $this->forge->createTable('oauth_clients', TRUE);
        }

        // Таблица oauth_scopes
        if (!$this->db->tableExists('oauth_scopes')) {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => FALSE,
                    'auto_increment' => TRUE
                ],
                'scope' => [
                    'type' => 'VARCHAR',
                    'null' => FALSE
                ],
                'is_default' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => TRUE
                ]
            ]);
            
            $this->forge->addKey('id', TRUE);
            $this->forge->createTable('oauth_scopes', TRUE);
        }

        // Таблица oauth_access_tokens
        if (!$this->db->tableExists('oauth_access_tokens')) {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => FALSE,
                    'auto_increment' => TRUE
                ],
                'access_token' => [
                    'type' => 'VARCHAR',
                    'null' => FALSE
                ],
                'scope' => [
                    'type' => 'VARCHAR',
                    'null' => TRUE
                ],
                'expires' => [
                    'type' => 'TIMESTAMP',
                    'null' => TRUE
                ],
                'user_id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => TRUE
                ],
                'client_id' => [
                    'type' => 'VARCHAR',
                    'null' => FALSE
                ]
            ]);
            
            $this->forge->addKey('id', TRUE);
            $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
            $this->forge->addForeignKey('client_id', 'oauth_clients', 'client_id', 'RESTRICT', 'RESTRICT');
            $this->forge->createTable('oauth_access_tokens', TRUE);
        }

        // Таблица oauth_refresh_tokens
        if (!$this->db->tableExists('oauth_refresh_tokens')) {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => FALSE,
                    'auto_increment' => TRUE
                ],
                'refresh_token' => [
                    'type' => 'VARCHAR',
                    'null' => FALSE
                ],
                'scope' => [
                    'type' => 'VARCHAR',
                    'null' => TRUE
                ],
                'expires' => [
                    'type' => 'TIMESTAMP',
                    'null' => TRUE
                ],
                'user_id' => [
                    'type' => 'INT',
                    'unsigned' => TRUE,
                    'null' => TRUE
                ],
                'client_id' => [
                    'type' => 'VARCHAR',
                    'null' => FALSE
                ]
            ]);
            
            $this->forge->addKey('id', TRUE);
            $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'RESTRICT');
            $this->forge->addForeignKey('client_id', 'oauth_clients', 'client_id', 'RESTRICT', 'RESTRICT');
            $this->forge->createTable('oauth_refresh_tokens', TRUE);
        }
    }

    public function down()
    {
        $this->forge->dropTable('oauth_refresh_tokens', TRUE);
        $this->forge->dropTable('oauth_access_tokens', TRUE);
        $this->forge->dropTable('oauth_scopes', TRUE);
        $this->forge->dropTable('oauth_clients', TRUE);
    }
}