<section>
    <div class="card-body">
        <div class="card-title">
            <h2 class="h5 fw-semibold mb-2">{{ __('Delete Account') }}</h2>
            <p class="text-muted small">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>

        <button 
            class="btn btn-danger" 
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            {{ __('Delete Account') }}
        </button>

        <!-- Modal -->
        <div 
            class="modal fade" 
            id="confirmUserDeletionModal" 
            tabindex="-1" 
            aria-labelledby="confirmUserDeletionModalLabel" 
            aria-hidden="true"
            x-data="{ show: @entangle('showModal').live }"
            x-show="show"
            x-transition
        >
            <div class="modal-dialog">
                <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small mb-4">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                placeholder="{{ __('Password') }}"
                            >
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button 
                            type="button" 
                            class="btn btn-secondary" 
                            data-bs-dismiss="modal"
                        >
                            {{ __('Cancel') }}
                        </button>
                        <button 
                            type="submit" 
                            class="btn btn-danger"
                        >
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('userDeletionModal', () => ({
        show: false,
        open() {
            this.show = true;
        },
        close() {
            this.show = false;
        }
    }))
})
</script>
@endpush