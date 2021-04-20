<template>
  <div>
    <h1>Checks</h1>
    <form>
      <div class="form-row">
        <div class="col">
          <label for="start_date">Start Date</label>
          <input type="date" class="form-control" name="start" />
        </div>
        <div class="col">
          <label for="end_date">End Date</label>
          <input type="date" class="form-control" name="end" />
        </div>
      </div>
      <br /><br />
      <div class="form-row">
        <div class="col">
          <label for="user">User</label>
          <select
            class="form-control"
            id="exampleFormControlSelect1"
            name="user"
          >
            <option>User 1</option>
            <option>User 2</option>
            <option>User 3</option>
            <option>User 4</option>
            <option>All</option>
          </select>
        </div>
      </div>
    </form>
    <br /><br />
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Total Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><button type="button" class="btn btn-info">Mark</button></td>
          <th scope="row">1</th>
        </tr>
        <tr>
          <td><button type="button" class="btn btn-info">Jaccob</button></td>
          <th scope="row">2</th>
        </tr>
        <tr>
          <td><button type="button" class="btn btn-info">Larry</button></td>
          <th scope="row">3</th>
        </tr>
      </tbody>
    </table>

    <table class="table table-hover table-primary mt-5 " >
      <thead>
        <tr>
          <th scope="col">Order Date</th>
          <th scope="col">Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><button type="button" class="btn btn-primary">2021-04-10</button></th>
          <td>25</td>
        </tr>
        <tr>
          <th scope="row"><button type="button" class="btn btn-primary">2021-03-25</button></th>
          <td>100</td>
        </tr>
        <tr>
          <th scope="row"><button type="button" class="btn btn-primary">2020-10-10</button></th>

          <td>10</td>
        </tr>
      </tbody>
    </table>

   <div class="p-3 mb-2  text-primary" style="background-color:#E8E8E8"><div class="d-flex flex-row">
  <div class="p-2">Tea</div>
  <div class="p-2">Ooffe</div>
  <div class="p-2">Orange Juice</div>
</div></div>
  </div>
</template>