<?php
/**
 * Created by [oiuv](https://github.com/oiuv).
 * User: i@oiuv.cn
 * Date: 2018-07-29
 * Time: 12:53
 */

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ExamHistory extends Model
{
    protected $table = 'examhistory';
    protected $primaryKey = 'ehid';
    public $timestamps = false;

    // 考试试卷
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'ehexamid');
    }

    // 考试考场
    public function basic()
    {
        return $this->belongsTo(Basic::class, 'ehbasicid');
    }

    // 考试用户
    public function user()
    {
        return $this->belongsTo(User::class, 'ehuserid');
    }

    // 加密压缩考试试题
    public function setEhquestionAttribute($value)
    {
        $this->attributes['ehquestion'] = base64_encode(gzcompress(serialize($value), 9));
    }

    // 加密压缩考试设置
    public function setEhsettingAttribute($value)
    {
        $this->attributes['ehsetting'] = base64_encode(gzcompress(serialize($value), 9));
    }

    // 解密考试试题
    public function getEhquestionAttribute($value)
    {
        return unserialize(gzuncompress(base64_decode($value)));
    }

    // 解密考试设置
    public function getEhsettingAttribute($value)
    {
        return unserialize(gzuncompress(base64_decode($value)));
    }
}
