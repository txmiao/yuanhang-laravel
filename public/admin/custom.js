$(function () {
    //删除
    $('body').on('click', '[data-href].delete', function () {
        var target = $(this);
        layer.confirm('确定删除此条记录吗？', {
            btn: ['确定', '取消'],
            icon: 3,
            title: '删除提示',
            skin: 'my-layer-skin-class'
        }, function () {
            $.get(target.attr('data-href'), {}, function (res) {
                layer.msg(res.msg);
                if (res.status) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            })
        }, function () {

        })
    });

    //锁定
    $('body').on('click', '[data-href].lock', function () {
        var target = $(this);
        $.get(target.attr('data-href'), {}, function (res) {
            layer.msg(res.msg);
            if (res.status) {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        })
    });

    //激活
    $('body').on('click', '[data-href].unlock', function () {
        var target = $(this);
        $.get(target.attr('data-href'), {}, function (res) {
            layer.msg(res.msg);
            if (res.status) {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        })
    });

    //更新
    $('body').on('click', '[data-href].update', function () {
        var target = $(this);
        $.get(target.attr('data-href'), {}, function (res) {
            layer.msg(res.msg);
            if (res.status) {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        })
    });

    //还原
    $('body').on('click', '[data-href].restore', function () {
        var target = $(this);
        layer.confirm('确定还原此条记录吗？', {
            btn: ['确定', '取消'],
            icon: 3,
            title: '还原提示',
            skin: 'my-layer-skin-class'
        }, function () {
            $.get(target.attr('data-href'), {}, function (res) {
                layer.msg(res.msg);
                if (res.status) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            })
        }, function () {

        })
    });

    //强制删除
    $('body').on('click', '[data-href].force_delete', function () {
        var target = $(this);
        layer.confirm('确定要永久删除此条记录吗？', {
            btn: ['确定', '取消'],
            icon: 3,
            title: '永久删除提示',
            skin: 'my-layer-skin-class'
        }, function () {
            $.get(target.attr('data-href'), {}, function (res) {
                layer.msg(res.msg);
                if (res.status) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            })
        }, function () {

        })
    });

    //加入黑名单
    $('body').on('click', '[data-href].add-black', function () {
        var target = $(this);
        layer.confirm('确定将此用户加入黑名单吗？', {
            btn: ['确定', '取消'],
            icon: 3,
            title: '操作提示',
            skin: 'my-layer-skin-class'
        }, function () {
            $.get(target.attr('data-href'), {}, function (res) {
                layer.msg(res.msg);
                if (res.status) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            })
        }, function () {

        })
    });

    //解除黑名单
    $('body').on('click', '[data-href].remove-black', function () {
        var target = $(this);
        layer.confirm('确定将此用户移出黑名单吗？', {
            btn: ['确定', '取消'],
            icon: 3,
            title: '操作提示',
            skin: 'my-layer-skin-class'
        }, function () {
            $.get(target.attr('data-href'), {}, function (res) {
                layer.msg(res.msg);
                if (res.status) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            })
        }, function () {

        })
    });

    //置顶
    $('body').on('click', '[data-href].top', function () {
        var target = $(this);
        layer.confirm('确定置顶此公司吗？', {
            btn: ['确定', '取消'],
            icon: 3,
            title: '操作提示',
            skin: 'my-layer-skin-class'
        }, function () {
            $.get(target.attr('data-href'), {}, function (res) {
                layer.msg(res.msg);
                if (res.status) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            })
        }, function () {

        })
    });

    //生成激活码
    $('body').on('click', '[data-href].createCode', function () {
        var target = $(this);
        $.get(target.attr('data-href'), {}, function (res) {
            layer.msg(res.msg);
            if (res.status) {
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }
        })
    });

});

/**
 * ajaxForm提交数据
 * @param formId
 */
function ajaxSubmitData(formId) {
    var options = {
        success: showResponse,  // post-submit callback,
        error: showError,
        // other available options:
        //target:    '',         // target element(s) to be updated with server response
        //url:       url         // override for form's 'action' attribute
        //type:      type        // 'get' or 'post', override for form's 'method' attribute
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
        //clearForm: true        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit

        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };

    // bind form using 'ajaxForm'
    $('#' + formId).ajaxForm(options);
}

/**
 * 提交成功回调
 * @param res
 */
function showResponse(res) {
    console.log(res);
    layer.msg(res.msg);
    if (res.code == 0 && res.status) {
        $('[data-dismiss]').click();
        if (res.jump) {
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    }
}

/**
 * 提交失败回调
 */
function showError() {
    layer.msg('操作失败，请稍后再试！');
}