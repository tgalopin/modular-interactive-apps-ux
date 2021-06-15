import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['selectField'];

    connect() {
        this.selectFieldTarget.addEventListener('change', () => {
            this.element.submit();
        });
    }
}
