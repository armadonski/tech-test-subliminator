import { Component, Input } from '@angular/core';

@Component({
  selector: 'cancel-item',
  templateUrl: './cancel-item.component.html',
})
export class CancelItemComponent {
  @Input() orderId?: number;

  handleCancelOrder() {
    console.log(this.orderId);
  }
}
