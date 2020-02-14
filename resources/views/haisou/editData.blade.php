<!DOCTYPE html>
<html>
<head>
	<title>Edit data</title>
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
	</script>
</head>
<body>
	
		<button onclick="my_func()">Search</button>
		<button onclick="location.href='{{url('/')}}'">All(refresh)</button>
		<button onclick="document.getElementById('updateData').submit()">Update</button>
		<button onclick="location.href='{{url('/data/delete/'.$dataById[0]->bango)}}'">Delete</button>

      <p>Total data:{{$total}}, Current Page:1 </p>
	
	<div style="text-align: center; color: red;">
		{{$errors->has('name') ? $errors->first('name'):''}} <br>
		{{$errors->has('address') ? $errors->first('address'):''}} <br>
		{{$errors->has('tel') ? $errors->first('tel'):''}}

	</div>
	<br>

	<div>
		<table style="width: 80%">
			<tr>
				<th><button onclick="location.href='{{url('/bango/sort')}}'">Bango</button>
				</th>
				<th><button onclick="location.href='{{url('/name/sort')}}'">Name</button></th>
				<th><button onclick="location.href='{{url('/address/sort')}}'">Address</button></th>
				<th><button onclick="location.href='{{url('/tel/sort')}}'">Tel</button></th>
			</tr>

			<tr>
			<form id="updateData" method="post" action="{{url('/data/update')}}">
				@csrf
				<td>{{ $dataById[0]->bango}}
					<input type="hidden" name="dataId" value="{{ $dataById[0]->bango }}">
				</td>
				<td><input type="text" name="name" placeholder="Enter name" value="{{ $dataById[0]->name }}"></td>
				<td><input type="text" name="address" placeholder="Enter address" value="{{ $dataById[0]->address }}"></td>
				<td><input type="number" name="tel" placeholder="Enter tel" value="{{ $dataById[0]->tel }}"></td>
			</form>
			</tr>
            
			<tr>
			    <td> {{ $dataById[0]->bango }} </td>
				<td> {{ $dataById[0]->name }} </td>
				<td> {{ $dataById[0]->address }} </td>
				<td> {{ $dataById[0]->tel }} </td>

			</tr>

					
		</table>
	</div>

</body>
</html>