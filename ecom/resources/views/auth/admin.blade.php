
        <div class="mt-5" style="margin: 4%; padding-left: 5px;">
           <h1 id="admin_forms" class="display-3">Admin Forms</h1> 
        </div>
        <div class="row m-10">
            <div class="col-6">
                <form style="height: 720px;" method="POST" action="{{ route('dashboard.addCamera') }}" class="admin_forms shadow">
                    @csrf
                    <div class="form_title mb-4">
                        Add Camera to Store
                    </div>

                    @if(session('cameraAdded'))
                    <div class="success_label">
                        <p>{{session('cameraAdded')}}</p>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input name="model" type="text" class="form-control @error('model') error_input @enderror" id="model">
                        @error('model')
                            <div class="error_text">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input name="price" type="number" class="form-control @error('price') error_input @enderror" id="price">
                        @error('price')
                            <div class="error_text">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="description" class="form-control @error('description') error_input @enderror" placeholder="Leave a comment here" id="description" style="height: 100px"></textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <div class="error_text">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if($categories->count())
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category Type</label>
                            <select id="category_id" name="category_id" class="form-select @error('category_id') error_input @enderror" aria-label="Default select example">
                                <option selected value="">Choose...</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="error_text">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> 
                    @endif

                    <button type="submit" class="btn canon_form_button">Submit</button>
                </form> 
            </div>
            <div class="col-6">
                
            <div class="shadow admin_forms mb-4" style="height: 350px;">
                <form method="POST" action="{{route('dashboard.addCategory')}}" class="">
                    @csrf
                    <div class="form_title mb-4">
                        Add Cemra Category
                    </div>

                    @if(session('category_success'))
                        <div class="success_label">
                            <p><span class="">{{ session('category_success') }}</span></p>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input name="category_name" type="text" placeholder="Enter Category Name" class="form-control @error('category_name') error_input @enderror" id="category_name">
                        @error('category_name')
                        <div class="error_text">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn canon_form_button">Submit</button>
                </form>
            </div>

            <div class="shadow admin_forms mb-4" style="height: 460px;">
                <form method="POST" action="{{route('dashboard.addPromo')}}" class="">
                    @csrf
                    <div class="form_title">
                        Add Promo-Code
                    </div>

                    @if(session('promo_success'))
                        <div class="success_label">
                            <p><span class="">{{ session('promo_success') }}</span></p>
                        </div>
                    @endif



                    <div class="mb-3">
                        <label for="code" class="form-label">Code Number</label>
                        <input name="code" type="text" placeholder="Enter Code NUmber" class="form-control @error('code') error_input @enderror" id="code">
                        @error('code')
                        <div class="error_text">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="percentage" class="form-label">Code Percentage</label>
                        <input name="percentage" type="number" placeholder="Enter Percentage of Code" class="form-control @error('percentage') error_input @enderror" id="percentage">
                        @error('percentage')
                        <div class="error_text">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="validity" class="form-label">Validity</label>
                        <input name="validity" type="number" placeholder="Enter Validity Period of Code" class="form-control @error('validity') error_input @enderror" id="validity">
                        @error('validity')
                        <div class="error_text">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn canon_form_button">Submit</button>
                </form>
            </div>

            </div>
        </div>
    


        <div style="margin: 4%; padding-left: 5px;">
          <h1 id="" class="display-3">Branch Seller Settings</h1> 
        </div>          
          <div class="shadow" style="height: 600px; margin-bottom: 5%;">
            <div class="row">
              <div class="col-6" style="padding: 4% 10%;">
                @if(session('branchAdded'))
                  <div class="success_label mt-2">
                    {{ session('branchAdded') }}
                  </div>
                @endif
                <form method="POST" action="{{ route('addBranch') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="branch_name" class="form-label">Store Branch Name</label>
                    <input name="branch_name" type="text" class="form-control" id="branch_name">
                  </div>
                  
                
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>



                <form method="POST" action="{{ route('addShootingSession') }}" class="mt-5"> 
                    @csrf
                    <div class="mb-3">
                        <label for="session_branch_id" class="form-label">Branch Name</label>
                        <select id="session_branch_id" name="session_branch_id" class="form-select">
                            <option selected value="">Choose...</option>
                            
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="session_day" class="form-label">Session Day</label>
                        <select id="session_day" name="session_day" class="form-select" disabled>
                            <option selected value="">Choose...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="session_duration" class="form-label">Session Duration</label>
                        <div style="display: flex;">
                        <input name="session_duration_start" maxlength="5" type="text" class="form-control" id="session_duration_start" placeholder="Starting Time">
                        <input name="session_duration_end" maxlength="5" type="text" class="form-control" id="session_duration_end" style="margin-left: 2%;" placeholder="Ending Time">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button> 
                </form>


              </div>
              <div class="col-6" style="padding: 4% 10%;">
                <form action="{{ route('setBranchSchedule') }}" method="POST">
                     @csrf
                    <div class="mb-3">
                        <label for="branch_id" class="form-label">Branch Name</label>
                        <select id="branch_id" name="branch_id" class="form-select">
                            <option selected value="">Choose...</option>
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div> 
                    

                    <div class="mb-3">
                        <label for="opening_hour" class="form-label">Opening Hours</label>
                        <div style="display: flex;">
                        <input name="opening_hour" maxlength="5" type="text" class="form-control" id="opening_hour">
                        <input name="closing_hour" maxlength="5" type="text" class="form-control" id="closing_hour" style="margin-left: 2%;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input name="date" type="date" class="form-control" id="date">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>


<script>

    const branches = @json($branches);
    const branch_schedules = @json($branch_schedules);
    let dates;
    $('#session_branch_id').change(function(){
        var branch_id = $(this).val();
        dates = [];
        getDays(branch_id);
        // console.log(dates);
        setUpDateSelect();
    });

    function getDays(branch_id){
        for(let i =0; i< branch_schedules.length; i++){
            if(branch_schedules[i].branch_id == branch_id){
                dates.push(branch_schedules[i]);
            }
        }
    }

    function setUpDateSelect(){
        $('#session_day').prop('disabled', false);
        $('#session_day').empty();
        var html = '<option value="" selected>Pick Date</option>' ;
        for(let i =0; i< dates.length; i++){
            var date = new Date(dates[i].date);
            var now = new Date();
            if(date - now > 0){
                html += `<option value="${dates[i].date}">${dates[i].date}</option>\n`;
            }
        }
        $('#session_day').html(html);  
    }
</script>

