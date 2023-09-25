<?php
namespace lbreak\QuickLark\consts;

class BiTableConst {

    //字段类型
    public const FIELD_TYPE_1 = 1; //多行文本
    public const FIELD_TYPE_2 = 2; //数字
    public const FIELD_TYPE_3 = 3; //单选
    public const FIELD_TYPE_4 = 4; //多选
    public const FIELD_TYPE_5 = 5; //日期
    public const FIELD_TYPE_7 = 7; //复选框
    public const FIELD_TYPE_11 = 11; //人员
    public const FIELD_TYPE_13 = 13; //电话号码
    public const FIELD_TYPE_15 = 15; // 超链接
    public const FIELD_TYPE_22 = 22; //地理位置
    public const FIELD_TYPE_1001 = 1001; //创建时间
    public const FIELD_TYPE_1002 = 1002; //最后更新时间
    public const FIELD_TYPE_1003 = 1003; //创建人
    public const FIELD_TYPE_1004 = 1004; //修改人

    public const VIEW_TYPE_GRID = 'grid';//表格视图
    public const VIEW_TYPE_KANBAN = 'kanban';//看板视图
    public const VIEW_TYPE_GALLERY = 'gallery';//画册视图
    public const VIEW_TYPE_GANTT = 'gantt';//甘特视图
    public const VIEW_TYPE_FORM = 'form';//表单视图
}