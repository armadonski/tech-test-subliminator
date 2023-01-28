import { Order } from "./order";

export interface Items {
    items: Order[],
    lastPage: number,
    total: number
}
