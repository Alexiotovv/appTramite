<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionReception extends Model
{
    protected $table = 'transaction_reception';

    protected $fillable = [
        'ruc_entity_sender',
        'name_entity_sender',
        'organic_unit_sender',
        'cod_reference',
        'transaction_number_doc_sender',
        'date_doc_sender',
        'organic_unit_end',
        'name_addressee',
        'job_title_addressee',
        'subject',
        'type_doc_register',
        'number_doc_register',
        'status',
        'user_id_assign',
        'office_id',
        'public_unit_code'
    ];

    public static function storeReception(
        ?string $rucEntitySender,
        ?string $nameEntitySender,
        ?string $organicUnitSender,
        ?string $codReference,
        string $transactionNumberDocSender,
        string $dateDocSender, 
        string $organicUnitEnd,
        ?string $nameAddressee,
        ?string $jobTitleAddressee,
        string $subject,
        string $typeDocRegister,
        string $numberDocRegister,
        int $status,
        int $userIdAssign,
        int $officeId,
        string $publicUnitCode
    ): int {
        $query = self::create([
            'ruc_entity_sender' => $rucEntitySender, 
            'name_entity_sender' => $nameEntitySender,
            'organic_unit_sender' => $organicUnitSender,
            'cod_reference' => $codReference,
            'transaction_number_doc_sender' => $transactionNumberDocSender,
            'date_doc_sender' => $dateDocSender,
            'organic_unit_end' => $organicUnitEnd,
            'name_addressee' => $nameAddressee,
            'job_title_addressee' => $jobTitleAddressee,
            'subject' => $subject,
            'type_doc_register' => $typeDocRegister,
            'number_doc_register' =>  $numberDocRegister,
            'status' => $status ,
            'user_id_assign' => $userIdAssign ,
            'office_id' => $officeId,
            'public_unit_code' => $publicUnitCode
        ]); 
        return $query->id;
    }
}