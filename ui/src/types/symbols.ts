import { type InjectionKey } from 'vue';
import { type IApi } from '@/interfaces/common/IApi';

const ApiKey: InjectionKey<IApi> = Symbol('api');
export { ApiKey }
