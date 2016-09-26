<div class="page-header">
    <h1>Oops!</h1>
</div>
<div class='well'><h1>ERROR Message: </h1>{{ $exception->getMessage() }}</div>
<div class='well'><h1>ERROR FIle&Line: </h1>{{ $exception->getFile().' ==== '.$exception->getLine() }}</div>
<div class='well'><h1>ERROR: </h1>{{ $exception->getTraceAsString() }}</div>