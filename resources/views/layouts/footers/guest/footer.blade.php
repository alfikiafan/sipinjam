<footer class="footer py-5">
  <div class="container">
    <div class="row">
      @if (!auth()->user() || \Request::is('static-sign-up')) 
      @endif
    </div>
    @if (!auth()->user() || \Request::is('static-sign-up')) 
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <span id="currentYear"></span>, Created by <strong>Group 4</strong>.
          </p>
        </div>
      </div>
    @endif
  </div>
</footer>
