<!DOCTYPE html>
<html>
<head>
	<title>Search results</title>
	<style type="text/css">
		button{
			margin: 5px;
			padding: 10px;
		}

		table,th,td{
			border: 1px solid black;
		}
		
	</style>
	<script type="text/javascript">
		function my_func() {
		    document.getElementById('insertData').action ="{{url('/data/search')}}";
			document.getElementById('insertData').submit();
		}
		function getBangoOrder() {

			var bango=document.getElementById('bango').value;

			if(bango == 'desc'){
				location.href="{{url('/bango/desc')}}";
				//document.getElementById('bango').value='asc';
			}
			else{
				location.href="{{url('/bango/asc')}}";
			}
		}

		function getNameOrder() {

			var name=document.getElementById('name').value;

			if(name == 'desc'){
				location.href="{{url('/name/desc')}}";
			}
			else{
				location.href="{{url('/name/asc')}}";
			}
		}

		function getAddressOrder() {

			var address=document.getElementById('address').value;

			if(address == 'desc'){
				location.href="{{url('/address/desc')}}";
			}
			else{
				location.href="{{url('/address/asc')}}";
			}
		}

		function getTelOrder() {

			var tel=document.getElementById('tel').value;

			if(tel == 'desc'){
				location.href="{{url('/tel/desc')}}";
			}
			else{
				location.href="{{url('/tel/asc')}}";
			}
		}
	</script>
</head>
<body>
	
		<button onclick="my_func()">Search</button>
		<button onclick="location.href='{{url('/')}}'">All(refresh)</button>
		<button onclick="document.getElementById('selectData').submit()">Choice</button>
		<button onclick="document.getElementById('insertData').submit()">Insert</button>

	<p>Total data:{{$total}} </p>

	<div style="text-align: center; color: red;">
		{{$errors->has('name') ? $errors->first('name'):''}} <br>
		{{$errors->has('address') ? $errors->first('address'):''}} <br>
		{{$errors->has('tel') ? $errors->first('tel'):''}}
		
	</div>
	<br>

	<div>
		<table style="width: 80%">
			<tr>
				<th><button id="bango" value="{{ Session::get('bangoOrder') }}" onclick="getBangoOrder();">Bango</button>
				</th>
				<th><button id="name" value="{{ Session::get('nameOrder') }}" onclick="getNameOrder()">Name</button></th>
				<th><button id="address" value="{{ Session::get('addressOrder') }}" onclick="getAddressOrder()">Address</button></th>
				<th><button id="tel" value="{{ Session::get('telOrder') }}" onclick="getTelOrder()">Tel</button></th>
			</tr>

			<tr>
			<form id="insertData" method="post" action="{{url('/data/insert')}}">
				@csrf
				<td><input type="text" name="bango" placeholder="Search by bango"></td>
				<td><input type="text" name="name" placeholder="Enter name"></td>
				<td><input type="text" name="address" placeholder="Enter address"></td>
				<td><input type="number" name="tel" placeholder="Enter tel"></td>
			</form>
			</tr>
            
				<form id="selectData" method="post" action="{{url('/data/select')}}" >
					@csrf
					@foreach($allData as $data)
					    <tr>
					    	<td>
					    		<input type="radio" name="selectId" value="{{$data->bango}}" >{{$data->bango}}
					    	</td>
					    	<td> {{$data->name}} </td>
					    	<td> {{$data->address}} </td>
					    	<td> {{$data->tel}} </td>

					    </tr>

					@endforeach
					
				</form>
				
		</table>

	</div>
   
</body>
</html>