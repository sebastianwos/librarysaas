
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */


Dropzone.options.library = {
    acceptedFiles: '.pdf',
    init: function() {
        this.on("success", function(file, response) {
            $('#preview').append('<tr> ' +
                    '<td><a href="'+response.show+'">'+response.name+'</a></td> ' +
                    '<td></td> ' +
                    '<td class="text-right"> ' +
                        '<a class="btn btn-xs btn-info" href="'+response.edit+'">Edit</a> ' +
                        '<form style="display: inline-block;" action="'+response.delete+'" method="POST"> ' +
                            '<input type="hidden" value="DELETE" name="_method" /> ' +
                            '<input type="hidden" value="'+response.token+'" name="_token" /> ' +
                            '<button class="btn btn-xs btn-danger">Delete</button> ' +
                        '</form> ' +
                    '</td> ' +
                '</tr>'
            );
        });
    }
}


Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: 'body'
});
