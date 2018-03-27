var school = 1;
var job = 1;
var lang = 1;
var limit = 5;

$("#addEducation").on('click', function(e) {
  e.preventDefault();
  school++;
  var objTo = document.getElementById('education');
  var div = document.createElement('div');
  div.setAttribute("class", "removeschool"+school);
  var rdiv = 'removeschool'+school;
  div.innerHTML =
                      '<div class="form-row">'+
                      '<div class="form-group col-md-8">'+
                          '<label for="education">Skola</label>'+
                          '<input type="text" name="school[]" class="form-control" id="inputSchool" placeholder="Skola"></input>'+
                        '</div>'+
                      '<div class="form-group col-md-4">'+
                      '<label for="sel1">Typ av utbildning</label>'+
                      '<i class="text-danger icon-close deleteButton pull-right" data-id="'+rdiv+'"></i>' +
                      '<select class="form-control" id="sel1" name="type[]">'+
                        '<option>Grundskola</option>'+
                        '<option>Högstadium</option>'+
                        '<option>Gymnasium</option>'+
                        '<option>Eftergymnasial Utbildning</option>'+
                      '</select>'+
                    '</div>' +
                    '</div>' +
                    '<div class="form-row">' +
                      '<div class="form-group col-md-6">' +
                        '<label for="startDate">Startdatum</label>' +
                        '<input name="sdate[]" type="month" class="form-control" id="startDate" placeholder="YYYY/MM/ÅÅ"></input>'+
                      '</div>'+
                      '<div class="form-group col-md-6">' +
                        '<label for="startDate">Slutdatum</label>' +
                        '<input name="edate[]" type="month" class="form-control" id="startDate"></input>'+
                      '</div>'+
                    '</div>';
  objTo.appendChild(div);

});

$("#addJob").on('click', function(e) {
  e.preventDefault();
  job++;
  var objTo = document.getElementById('jobs');
  var div = document.createElement('div');
  div.setAttribute("class", "removejob"+job);
  var rdiv = 'removejob'+job;

  div.innerHTML = '<div class="form-row">'+
                    '<div class="form-group col-md-12">' +
                      '<label for="jobRole">Jobb</label>'+
                      '<i class="text-danger icon-close deleteButton pull-right" data-id="'+rdiv+'"></i>'+
                      '<input name="role[]" type="text" class="form-control" id="jobRole" placeholder="Jobb"></input>'+
                      '<small id="jobHelp" class="form-text text-muted">T.ex. Butiksbiträde, Cafépersonal, Lagerarbetare, Barnvakt</small>' +
                    '</div>'+
                  '</div>'+
                  '<div class="form-row">'+
                    '<div class="form-group col-md-12">'+
                      '<label for="company">Vilket företag eller organisation jobbade du för?</label>'+
                      '<input name="company[]" type="text" class="form-control" id="jobRole" placeholder="Företag"></input>'+
                      '<small id="jobHelp" class="form-text text-muted">T.ex. Securitas, ICA, McDonalds, Espresso House</small>'+
                    '</div>'+
                  '</div>'+
                  '<div class="form-row">'+
                    '<div class="form-group col-md-6">'+
                      '<label for="startDate">Startdatum</label>'+
                    '<input name="jobsdate[]" type="month" class="form-control" id="startDate" placeholder="YYYY/MM/ÅÅ"></input>'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                      '<label for="startDate">Slutdatum</label>'+
                      '<input name="jobedate[]" type="month" class="form-control" id="startDate" placeholder="YYYY/MM/ÅÅ"></input>'+
                    '</div>'+
                  '</div>';

  objTo.appendChild(div);

});

$("#addLang").on('click', function(e) {
  e.preventDefault();
  lang++;
  var objTo = document.getElementById('language-skills');
  var div = document.createElement('div');
  div.setAttribute("class", "removelang"+lang);
  var rdiv = 'removelang'+lang;

  div.innerHTML =  '<div class="form-row">' +
                    '<div class="form-group col-md-8">' +
                      '<label for="language">Vilket språk?</label>' +
                      '<input name="lang[]" type="text" class="form-control" id="language" placeholder="T.ex. Svenska">' +
                    '</div>' +
                    '<div class="form-group col-md-4">' +
                      '<label for="lang-sel">Vilken nivå?</label>' +
                      '<i class="text-danger icon-close deleteButton pull-right" data-id="'+rdiv+'"></i>'+
                      '<select class="form-control" id="lang-sel" name="langlvl[]">' +
                        '<option>Grundläggande kunskaper</option>' +
                        '<option>Goda kunskaper</option>' +
                        '<option>Mycket goda kunskaper</option>' +
                      '</select>' +
                    '</div>' +
                '</div>';

  objTo.appendChild(div);
})

$("body").on('click', 'button.nextBtn', function(e) {
  e.preventDefault();
  var next = $(this).closest('.step').data('step');
  console.log(next);
  $("#step"+next).fadeOut(300, function() {
    $("#step"+(next+1)).fadeIn(300);
  });
});

$("body").on('click', 'button.prevBtn', function(e) {
  e.preventDefault();
  var next = $(this).parents('.step').data('step');
  console.log(next);
  $("#step"+next).fadeOut(300, function() {
    $("#step"+(next-1)).fadeIn(300);
  });
});

$("body").on('click', "i.deleteButton", function(e) {
    e.preventDefault();
    var rid = $(this).data('id');
    $("."+rid).remove();
});

$('input.skill-checkbox').on('change', function(evt) {
  console.log($('input.skill-checkbox:checkbox:checked').length)
   if($('input.skill-checkbox:checkbox:checked').length > limit) {
       this.checked = false;
   }
});


$("#submit-form").click(function(e){
  var form = $("#registration-form");
  e.preventDefault();
  $.ajax({
      type:"POST",
      url:'fetch.php',
      data: $("#registration-form").serialize(),//only input
      success: function(response){
        $('#step4').fadeOut(300, function(){
          $('#registration-form').append(successmsg);
        })
      }
  });
});

var successmsg = "<div class='col-md-12 text-center'>" +
                  "<h2 class='mb-5'>Steg 3. Slappna av och låt oss göra jobbet</h2>" +
                  "<h2 class='mb-5'>Tack för din beställning!</h2>" +
                 "<h3 class='mb-2'>Vi skickar ditt CV till dig inom 24h</h3>" + 
                 "<p>I mailet kommer du även få en faktura som du betalar genom Swish.</p>"+
                 "</div>";

// Get the modal
$(function() {
    $('.pop').on('click', function(e) {
      e.preventDefault();
      var radio = $(this).find('img').data('name');
      var btnhtml = ' <button id="select-template" data-name="'+radio+'" class="col-md-3 btn btn-primary">Välj</button>';
      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#modal-btn').html(btnhtml);
      $('#imagemodal').modal('show');
    });   

    $('body').on('click',"#select-template", function(e) {
      e.preventDefault();
      var radiobtn = $(this).data('name'); 
      $('#'+radiobtn).prop('checked', true);
      $('#imagemodal').modal('hide');
      console.log(radiobtn);  

    })
});
