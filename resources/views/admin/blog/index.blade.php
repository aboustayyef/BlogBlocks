@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>Blogs At LB</h1>
        <div class="row">
            <div class="col-md-2">
                <a href="{{route('blog.create')}}" class="btn btn-primary">Create New Blog</a>
            </div>
            <div class="col-md-4 pull-right">
                <input type="text" placeholder="Filter Results" v-model="filter_key" class="form-control">
            </div>
        </div>
        
    </div>
    <table class="table table-striped" style="margin-top:2em">
        <thead>
            <tr>
                <th><a @click="sortNumeric" data-sort="id" href="#">ID</a></th>
                <th><a @click="sort" data-sort="name" href="#">Name</a></th>
                <th><a @click="sort" data-sort="description" href="#">Description</a></th>
                <th><a @click="sort" data-sort="author" href="#">author</a></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="blog in this.filtered_blogs" v-if="appReady"> 
                <th v-text="blog.id"></th>
                <td>@{{blog.name}}</td>
                <td>@{{blog.description}}</td>
                <td>@{{blog.author}}</td>
                <td><a :href=`/admin/blog/${blog.id}/edit`>edit</a></td>
            </tr>
        </tbody>
    </table> 
</div>
@stop

@section('extra_scripts')
    <script>
        var app = new Vue({
            el: '#app',
            mounted(){
                axios.get('/api/blog').then((response) => {
                    this.all_blogs= response.data;
                    this.appReady = 1;
                });
            },
            data: {
                appReady : 0,
                all_blogs: [],
                filter_key: "",
            },
            computed: {
                // a computed getter
                filtered_blogs: function () {
                    return this.all_blogs.filter((blog) =>
                        (blog.name.toLowerCase().includes(this.filter_key.toLowerCase()) || blog.name.toLowerCase().includes(this.filter_key.toLowerCase()) || blog.description.toLowerCase().includes(this.filter_key.toLowerCase()) || blog.author.toLowerCase().includes(this.filter_key.toLowerCase()))
                    );
                }
              },
            methods:
            {
                sortNumeric: function(e){
                    var sorting_key = e.target.dataset.sort;
                    this.all_blogs.sort(function(a,b){
                        var valueA = a[sorting_key];
                        var valueB = b[sorting_key];
                        if (valueA < valueB) {
                            return -1;
                        }
                        if (valueA > valueB) {
                            return 1;
                        }
                        return 0;
                    });
                },
                sort: function(e){
                    // sort by name
                    var sorting_key = e.target.dataset.sort;
                    this.all_blogs.sort(function(a, b) {
                      var valueA = a[sorting_key].toUpperCase(); // ignore upper and lowercase
                      var valueB = b[sorting_key].toUpperCase(); // ignore upper and lowercase
                      if (valueA < valueB) {
                        return -1;
                      }
                      if (valueA > valueB) {
                        return 1;
                      }
                      // names must be equal
                      return 0;
                    });
                }
            },
        });
    </script>
@stop