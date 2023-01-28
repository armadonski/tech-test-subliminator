import { Items } from "./items";

export interface OrderResponse {
    result: Items,
    errors: string[],
  }
  