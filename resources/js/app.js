/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var Evaporate = require('./evaporate');
require('./sha256');
var csrf_token = $('meta[name="_token"]').attr('content');
var files;
var results = $('#results');

window.Vue = require('vue');

let amazon_key = 'AKIAIBY5ZKH7UWLLPRHA';

$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".page__items li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});
$('.item').click(function(e){
    e.preventDefault();

    const id = $(this).data("id");
    const imgSrc = $(this).data("image");

    if($(this).hasClass("selected")) {
        $(this).removeClass("selected");
        $('.img' + id).remove();
        // console.log("Remove " + id);
    } else {
        $(this).addClass("selected");
        $('.page__fixed__selected').append("<li class='" + "img" + id + "'><img src='https://d3d4x44eptevwm.cloudfront.net/sm/wardrobe/" + imgSrc + "' width='50'></li>");
        $('#outfit_image_ids').append("<input type='hidden' class='" + "img" + id + "' name='items[]' value='" + id + "'>");
        // console.log("Add " + id);
    }

    var numItems = $('.item.selected').length;

    if(numItems > 0) {
        $('.page__fixed').addClass("show");
    } else {
        $('.page__fixed').removeClass("show");
    }

    // console.log(numItems);
    $('.data--selected').text(numItems);
});

$('#create-outfit').click(function(e){
    e.preventDefault();
    $('.create__outfit').addClass("show");
});


$('.sidebar__categories__item__selector').click(function(e){
  e.preventDefault();
  $(this).toggleClass("active");
  $(this).next().slideToggle("fast");
});

$('.sidebar__categories__item__options__item').click(function(e){
  e.preventDefault();
  // console.log($(this).data("id"));
  $(this).toggleClass("selected");

  filterSelection();
});

$('#want-link').change(function(e){
  e.preventDefault();
  const url = $(this).val();

  if(url.length > 0) {
    const fileData = {
      'url' : url
    }
  
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') } });
  
    $.ajax({
      type: "GET",
      url: '/scrape',
      data : fileData,
      success: function (data) {
          console.log(JSON.parse(data));
          const thumbnails = JSON.parse(data);

          let template = `<ul class="create__thumbnails">`;
          
          for(var i = 0; i < thumbnails.length; i++) {

            template += `<li>
              <img src="${thumbnails[i]}">
              <input type="hidden" name="link_media[]" value="${thumbnails[i]}">
            </li>`;
        
            console.log(thumbnails[i]);
        }

        template += `</ul>`;

        $("#images").html(template);

      },
      error: function (data) {
          console.log('Error:', data);
      }
    });
  }

});


$('#reset-filters').click(function(e){
  e.preventDefault();
  // console.log($(this).data("id"));
  $(this).toggleClass("selected");

  resetSelection();
});



// Grid views
$('#stack').click(function(e){
  e.preventDefault();
  if(!$(this).hasClass("active")) {
    $(".toggles .btn-tertiary").toggleClass("active");
    $('.page__items').toggleClass("grid");
  }
});

$('#grid').click(function(e){
  e.preventDefault();
  if(!$(this).hasClass("active")) {
    $(".toggles .btn-tertiary").toggleClass("active");
    $('.page__items').toggleClass("grid");
  }
});

$('#files').change(function(evt){
    files = evt.target.files;
    var uniqueIdentifier = [];
    var uploadType = $('#upload_type').val();
    var jobId = false;
    var isZip = true;
  
    if($('#post_id').val()) {
      jobId = $('#post_id').val();
    }
  
    var uploader = new Evaporate({
      signerUrl: '/sign_auth',
      aws_key: amazon_key,
      bucket: 'test-lewis/wardrobe',
      aws_url: 'https://s3-eu-west-1.amazonaws.com',
      awsSignatureVersion: '2'
    });
  
    for (var o = 0; o < files.length; o++){
  
          (function(i) {
  
            var file = files[i];
            uniqueIdentifier[i] = file.name + "_" + file.size;
  
            // Make sure it's zip file
            // if(file.type !== "application/zip") {
            //   isZip = false
            // }
  
            // Echo out friendly size
            var sizeInMb = parseInt(file.size) / parseInt(1048576);
            sizeInMb = sizeInMb.toFixed(2);
            var fileSizeText = sizeInMb + "MB";
  
            // If KB
            if(sizeInMb < 1) { fileSizeText = sizeInMb + "KB"; }
  
            // If GB
            if(sizeInMb > 1024) { fileSizeText = sizeInMb / 1024 + "GB"; }
  
              var template =
                  '<div class="row upload__name">' +
                    '<div class="col-md-9">' + file.name  + ' - ' + fileSizeText + '</div>' +
                    '<div class="col-md-3 tar" data-uniquePercentage="' + uniqueIdentifier[i] + '">Ready</div>' +
                  '</div>' +
  
                  '<div class="row">' +
                    '<div class="col-md-12">' +
                      '<div class="progress">' +
                        '<div data-uniqueid="' + uniqueIdentifier[i] + '" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                      '</div>' +
                    '</div>' +
                  '</div>';
  
              results.append(template);
  
          })(o);
  
    } // for
  
    // If is Zip files then so Buttons
    $('#clear').show();
  
    if(isZip) {
      $('#upload').show();
      $('#inputFile').slideToggle();
          $('.upload__gif').slideToggle();
          $(".upload__note").hide();
          $(".upload__title").text("Upload your zip file");
          $(".upload__sub-title").text("Your file is ready to upload");
    } else {
      $(".upload__note").addClass("enforce");
          $(".upload__note").show();
    }

  
      for (var o = 0; o < files.length; o++){
  
            (function(i) {
  
              var file = files[i];
              uniqueIdentifier[i] = file.name + "_" + file.size;
  
              uploader.add({
                name: slugify(file.name),
                file: files[i],
                xAmzHeadersAtInitiate : {
                   'x-amz-acl': 'public-read'
                },
                complete: function(r){
                   itemsProcessed++;
  
                   $('[data-uniqueId="' + uniqueIdentifier[i] + '"]').css('width', '100%').addClass("progress-bar-success");
                   $('#upload').hide();
                   $('.create__upload__success').addClass("active");

                   $("#image").append("<input type='hidden' name='image[]' value='" + slugify(file.name) + "' >");
                   
                   if(itemsProcessed === files.length) {
                    $(".upload__title").text("Upload complete");
                    $(".upload__state-upload").addClass("hide");
                    $(".upload__state-success").addClass("show");
                    // location.reload(); 
                  }
  
  
                },
                progress: function(progress){
                  var progressNumber = Math.floor(progress*100);
                  $('[data-uniqueId="' + uniqueIdentifier[i] + '"]').css('width', progressNumber + '%');
                  $('[data-uniquePercentage="' + uniqueIdentifier[i] + '"]').html('&nbsp;' + progressNumber + '%');
                }
              });
  
            })(o);
  
  
      } // for
  
  });

  function slugify(string) {
    const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
    const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
    const p = new RegExp(a.split('').join('|'), 'g')
    return string.toString().toLowerCase()
      .replace(/\s+/g, '-') // Replace spaces with -
      .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
      .replace(/&/g, '-and-') // Replace & with ‘and’
      // .replace(/[^\w\-]+/g, '') // Remove all non-word characters
      .replace(/\-\-+/g, '-') // Replace multiple - with single -
      .replace(/^-+/, '') // Trim - from start of text
      .replace(/-+$/, '') // Trim - from end of text
  }

  function filterSelection() {
    $(".item").hide();
    let dataItems = [];
    $(".selected").each(function(i, option) {
      const id = $(this).data("id");
      const parent = $(this).data("parent");
      $(".page__items li").filter(function() {
        $(this).toggle($(this).text().indexOf(id) > -1);
      });

    });

  } 

  function resetSelection() {
    $(".show").hide();
    $(".selected").removeClass("selected");
  }
  