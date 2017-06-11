<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Employer
 *
 * @property int $id
 * @property string $fio
 * @property string $position
 * @property string $date
 * @property int $salary
 * @property int $chief
 * @property string $img_path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Employer[] $childs
 * @property-read \App\Employer $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Employer whereChief($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employer whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employer whereFio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employer whereImgPath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employer wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employer whereSalary($value)
 * @mixin \Eloquent
 */
class Employer extends Model
{

    
    public $timestamps = false;
    
    protected $fillable = ['id', 'fio', 'position', 'date', 'salary', 'chief', 'img_path'];

    /**
     * Get employer dependents
     *
     * @return \App\Employer
     */
    public function childs()
    {
        return $this->hasMany('App\Employer', 'chief', 'id');
    }
    /**
     * Get employer chief
     *
     * @return \App\Employer
     */
    public function parent()
    {
        return $this->belongsTo('App\Employer', 'chief', 'id');
    }
}
