$(document).ready(function () {
    $('#password').keyup(   function(){
        $('input[name=password]').val(Base64.encode($('#password').val()));
    });

    $('#submit[name=usersadd]').on('click', function(){
        userAdd();
    });
    $('a[href="#responsible"]').on('click', function(){
        resloadData();
        // indicatorUpdate('stop');
    });
    $('a[href="#statistic"]').on('click', function(){
        statLoad();
    });
    $('a[href="#statistic2"]').on('click', function(){
        statLoad(2);
    });
    $('a[href="#indicator"]').on('click', function(){
        $('#indicResult').html('');
        indicatorLoad();
        // indicatorUpdate('start');
    });
    $('a[href="#enterdata"]').on('click',function(){
        $('#indicatorResult').html('');
    });
    $('a[href="#indic"]').on('click', function(){
        indicLoad();
        // indicatorUpdate('start');
    });
    $('a[href="#settings"]').on('click',function(){
        usersTableLoad();
        // indicatorUpdate('stop');
    });
    $('a[href="#42000"]').on('click', function(){
        dbLoad('db','db42');
        // indicatorUpdate('stop');
    });
    $('a[href="#all"]').on('click', function(){
        dbLoad('alldata','alldata');
        // indicatorUpdate('stop');
    });

    $('#addPeople').on('click',function(){
        values = $('#pep_id').val()
        addPeople(values);
    });
    if(($('#all').attr('class')=='tab-pane fade in active')||($('#all').attr('class')=='tab-pane fade active in')){
        dbLoad('alldata','alldata');
    }
    if(($('#settings').attr('class')=='tab-pane fade in active')||($('#settings').attr('class')=='tab-pane fade active in')){
        $('a[href="#settings"]').click();
    }
    if(($('#responsible').attr('class')=='tab-pane fade in active')||($('#settings').attr('class')=='tab-pane fade active in')){
        resloadData();
    }
    $('#check').on('click',function(){
        checkData()
    });
    $('#pep_id').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });
    $('#res_id').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });
    $('#res_tel').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });
    $('input[name=enterdata]').on('click',function(){
        electionData();
    });
    $('a[href="#exit"]').on('click', function(){
        exit();
    });
    $('a[href="#russian"]').on('click', function(){
        langChange('ru');
    });
    $('a[href="#hewrit"]').on('click', function(){
        langChange('he');
    });
    $("button[class='remove']").on('click',function(){
        id=$(this).attr('data-id');
        person=$(this).attr('data-person');
        $.post('/function/post.php', {'FakeRemove': 'ok', 'person': person, 'RemovedId': id})
            .done(function(){
                $('#'+id).remove();
            });
    });
    $('#updateIndic').on('click',function(){
        indicLoad();
    });
    // $("button[class='btn btn-info btn-lg']").on('click',function(){
    //     section = $(this).attr('data-section');
    //     sectionTitle = $(this).attr('data-sectionTitle');
    //     alldata = $(this).attr('data-alldata');
    //     allElections = $(this).attr('data-allElections');
    //     db = $(this).attr('data-db');
    //     dbElections = $(this).attr('data-dbElections');
    //     console.log(section);
    //     console.log(sectionTitle);
    //     console.log(alldata);
    //     console.log(allElections);
    //     console.log(db);
    //     console.log(dbElections);
    //     $.post('/function/chartshow.php',{'title': sectionTitle+' '+section, 'id': section, 'alldata':alldata,'allElections':allElections,'db':db,'dbElections':dbElections,'pieChart':'show'})
    //         .done(function(data){
    //         $('#result_'+section).html(data);
    //     });
    //
    // })
    $('#search42ID').keyup(function(){
        // console.log($(this).val());
        if($(this).val().length>0){
            $.post('/function/post.php',{'dbload':'sort', 'val': $(this).val(), 'table': 'db'})
                .done(function(data){
                    $('#db42').html(data);
                })
        }else{
            dbLoad('db','db42');
        }

    })
    $('#searchAllDataID').keyup(function() {
        // console.log($(this).val());
        if ($(this).val().length > 0) {
            $.post('/function/post.php', {'dbload': 'sort', 'val': $(this).val(), 'table': 'alldata'})
                .done(function (data) {
                    $('#alldata').html(data);
                })
        } else {
            dbLoad('alldata','alldata');
        }
    })
});

$(document).on('scroll',function(){
    doc_height = $(document).height();
    scroll_top = $(window).scrollTop()+$(window).height();
    limitsdb42 = $('#db42> tr:last-child').attr('data-limit');
    limitsalldata = $('#alldata> tr:last-child').attr('data-limit');
    if(scroll_top>500){
        $('#upbutton').css({'display':'block'});
    }else if(scroll_top<=500){
        $('#upbutton').css({'display':'none'});
    }
    if(scroll_top>=(doc_height)) {
        listdb42 = $('#42000').attr('class');
        listalldata = $('#all').attr('class');
        if (listdb42=='tab-pane fade active in'){
            dbLoad('db','db42',limitsdb42,'append');
        }
        else if((listalldata=='tab-pane fade in active')||(listalldata=='tab-pane fade active in')){
            dbLoad('alldata','alldata',limitsalldata,'append');
        }

    }
});
function usersTableLoad(){
    $.post('/function/post.php',{userstable: 'load'})
        .done(function(data){
            $('#userstable').html(data);
        })
}
function userAdd(){
    login = $.trim($('input[name=login]').val());
    pass = $('input[name=password]').val();
    $.post('/function/post.php',{'useradd': 'add', 'login': login, 'password': pass })
        .done(function(data,textStatus){
            if (textStatus=='success'){
                $('#submit').val(app.$data.OK).addClass('btn-success').removeClass('btn-default');
                setTimeout(function () {
                    $('#submit').val(app.$data.buttonAdd).addClass('btn-default').removeClass('btn-success');
                    usersTableLoad();
                },2000)
            }else if(textStatus=='notmodified'){
                $('#submit').val(app.$data.ERROR).addClass('btn-warning').removeClass('btn-default');
                $('#submiterror').html(app.$data.errorQueryDB);
                setTimeout(function () {
                    $('#submit').val(app.$data.buttonAdd).addClass('btn-default').removeClass('btn-warning');
                    $('#submiterror').html('')
                },5000)
            }

        })
        .fail(function(data,textStatus){
            if (textStatus=='error'){
                $('#submit').val(app.$data.ERROR).addClass('btn-warning').removeClass('btn-default');
                $('#submiterror').html(app.$data.thisUserExist);
                setTimeout(function () {
                    $('#submit').val(app.$data.buttonAdd).addClass('btn-default').removeClass('btn-warning');
                    $('#submiterror').html('')
                },5000)
            }
        })
}
function dbLoad(table,idload,limits = 0,how='html'){
    dbload=true;
   $.post('/function/post.php',{'dbload':'load', 'table': table, 'limits': limits})
       .done(function(data,textStatus) {
           if(textStatus=='success'){
               if (how=='html'){
                   $('#'+idload).html(data);
                   dbload=false;
               }else if (how=='append'){
                   $('#'+idload).append(data);
                   dbload=false;
               }
           }else if(textStatus=='notmodified'){
               $('#'+idload+'error').html(app.$data.errorQueryDB).addClass('text-danger');
           }
       })
}
function addPeople(id){
    $("div[data-add='1']").before('<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> '+id+'</span></div>')
    data = $('input[name=pep_id]').val()
    $('input[name=pep_id]').val(data+';;'+id);
    $('#pep_id').val('');
    $('#addPeople').attr('disabled','disabled');
}
function checkData(){
    values = $('#pep_id').val();
    $.post('/function/post.php',{'check': 'checkpeople', 'val': values})
        .done(function(data,textStatus){
            // console.log(textStatus)
            if(textStatus=='success'){
                $('#pep_check').html(data);
                $('#pep_id').css({'border': '1px solid #ccc'})
                $('#check').html('<i class="glyphicon glyphicon-eye-open"></i> '+app.$data.Check)
                $('#check').attr('class','input-group-addon btn-success')
                $('#addPeople').removeAttr('disabled')
                $('#all_save').removeAttr('disabled')
            }
            if(textStatus=='notmodified'){
                $('#pep_id').css({'border': '1px solid red'})
                $('#check').html('<i class="glyphicon glyphicon-eye-open"></i> '+app.$data.ERROR)
                $('#check').attr('class','input-group-addon btn-danger')
                $('#addPeople').attr('disabled','disabled')
                $('#all_save').attr('disabled','disabled')
                setTimeout(function(){
                    $('#check').html('<i class="glyphicon glyphicon-eye-open"></i> '+app.$data.Check)
                    $('#check').attr('class','input-group-addon btn-success')
                    $('#pep_id').css({'border': '1px solid #ccc'})
                },3000)
            }
        })
}
function resloadData(){
    $.post('/function/post.php',{'resLoad':'load'})
        .done(function(data){
            $('#res_load').html(data);
        })

}
function electionData(){
    section = $('#section').val();
    elections = $('#elections').val();
    // console.log('section='+section+'; elections='+elections);
    $.post('/function/post.php',{'election':'add','section':section,'elections':elections})
        .done(function(data,textStatus){
            if(textStatus == 'success'){
             $('input[name=enterdata]').val(app.$data.OK);
             $('input[name=enterdata]').attr('class','form-control btn-success');
             $('#submitenterdataerror').html('<ol>'+data+'</ol>');
             $('#section').val('null');
             $('#elections').val('');
                 setTimeout(function(){
                     $('input[name=enterdata]').val(app.$data.buttonAdd);
                     $('input[name=enterdata]').attr('class','form-control btn-default');
                     // $('#submitenterdataerror').html('');
                 },3000);
                setTimeout(function(){
                    $('#submitenterdataerror').html('');
                },10000);
            }else if(textStatus=='notmodified'){
                $('input[name=enterdata]').val(app.$data.ERROR);
                $('input[name=enterdata]').attr('class','form-control btn-danger');
                $('#submitenterdataerror').html(app.$data.notModif);
                $('#submitenterdataerror').css({'color': 'red'});
                setTimeout(function(){
                    $('input[name=enterdata]').val(app.$data.buttonAdd);
                    $('input[name=enterdata]').attr('class','form-control btn-default');
                    $('#submitenterdataerror').html('');
                },3000)
            }
        })
}
function indicatorLoad(){
    $('#indicatorResult').html('<img src="/img/loader.gif" width="30" height="30" alt="loader">');
    $.get('/function/indicator.php')
        .done(function(data){
            $('#indicatorResult').html(data);
            $('span.glyphicon.glyphicon-refresh').toggleClass('click');
            setTimeout(function(){
                $('span.glyphicon.glyphicon-refresh').toggleClass('click');
            },2000)
        })
}
function indicLoad(){
    $.get('/function/indic.php')
        .done(function(data){
            $('#indicResult').html(data);
            $('span.glyphicon.glyphicon-refresh').toggleClass('click');
            setTimeout(function(){
                $('span.glyphicon.glyphicon-refresh').toggleClass('click');
            },2000)
        })
}
function indicClear(){
    $.post('/function/post.php',{'indicClear':'clear'}).done(function(){
        indicLoad();
    })
}
function exit(){
    console.log('exit');
    $.post('/function/post.php',{exit: 'ok'})
        .done(function(){
            location.reload();
        })
}
function langChange(lang){
    $.post('/function/post.php', {'lang': lang})
    .done(function(){
        location.reload();
    })
}
function statLoad(id=''){
    $.get('/function/chart'+id+'.php')
        .done(function(data){
            $('#stat'+id).html(data);
        })
}
