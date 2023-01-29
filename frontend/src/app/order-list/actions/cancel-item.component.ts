import { Component, Input, ViewChild } from '@angular/core';
import { OrderListComponent } from '../order-list.component';

@Component({
  selector: 'cancel-item',
  templateUrl: './cancel-item.component.html',
})
export class CancelItemComponent {
  @Input()
  action!: (args: any) => void;
  @Input()
  args!: (args: any) => void;

  handleCancelOrder(): void {
    this.action(this.args);
  }
}
